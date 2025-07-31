<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\UserService as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface as AddressRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Enums\UserStatusEnum;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;

class UserController extends Controller
{
    protected $userService;

    protected $userRepository;

    protected $addressRepository;
    protected $roleRepository;

    public function __construct(UserService $userService, UserRepository $userRepository, AddressRepository $addressRepository, RoleRepository $roleRepository)
    {
        // $this->middleware('permission:view_all_users', ['only' => ['index']]);
        // $this->middleware('permission:create_users', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit_all_users', ['only' => ['update','edit']]);
        // $this->middleware('permission:delete_all_users', ['only' => ['destroy']]);

        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
        $this->addressRepository = $addressRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'sort_by' => 'nullable|in:name,email,created_at,id',
            'sort_direction' => 'nullable|in:asc,desc',
        ]);

        $filterParams = [
            'conditions' => $request->only('keyword', 'start_date', 'end_date'),
            'sort' => $request->only('sort_by', 'sort_direction')
        ];
        $roles = $this->roleRepository->getAll();

        $users = $this->userService->listAllPaginated($filterParams);
        return view('backend.admin.user.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $roles = Role::pluck('name', 'name')->all();
        $paymentMethods = PaymentMethod::all();
        $userStatusEnum = UserStatusEnum::cases();

        return view('backend.admin.user.create', compact('roles', 'paymentMethods', 'userStatusEnum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $user = $this->userRepository->create([
                'name' => $request->name,
                'email' => strtolower($request->email),
                'password' => Hash::make($request->password)
            ]);

            $this->addressRepository->create([
                'user_id' => $user->id,
                'fullname' => $request->input('fullname'),
                'number_phone' => $request->input('phone_number'),
                'address_1' => $request->input('address_1'),
                'address_2' => $request->input('address_2'),
                'region' => $request->input('region'),
                'city' => $request->input('city'),
                'zipcode' => $request->input('zipcode'),
            ]);

            if ($request->filled('roles')) {
                $user->syncRoles($request->roles);
            }

            if (empty($user->paymentMethod)) {
                $user->paymentMethod()->create(['payment_method_id' => $request->payment_method, 'details' => json_encode($request->fields)]);
            } else {
                $user->paymentMethod->payment_method_id = $request->payment_method;
                $user->paymentMethod->details = json_encode($request->fields);
                $user->paymentMethod->save();
            }

            DB::commit();
            if ($request->submitter === 'apply') {
                return redirect()->back()->with('success', 'Người dùng <b>' . $user->name . '</b> đã cập nhật thành công..!');
            } else {
                return redirect()->route('admin.users.index')->with('success', 'Người dùng <b>' . $user->name . '</b> đã cập nhật thành công..!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Thêm người dùng không thành công, hãy thử lại...');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $_data = $this->userService->show($request, $id);
        $data = $_data;

        return view('backend.admin.user.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $user = $this->userRepository->with(['address'])->find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        $paymentMethods = PaymentMethod::all();
        $userStatusEnum = UserStatusEnum::cases();

        return view('backend.admin.user.edit', compact('user', 'userRoles', 'roles', 'paymentMethods', 'userStatusEnum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $validated = $request->validated();
        $user = $this->userRepository->findOrFail($id);


        $userData = [
            'name' => $request->name,
            'email' => strtolower($request->email),
        ];

        if ($request->input('is_change_password') === '1') {
            $userData['password'] = Hash::make($request->password);
        }

        $this->userRepository->update($id, $userData);

        $this->addressRepository->getModel()->updateOrInsert(['user_id' => $id], [
            'fullname' => $request->input('fullname'),
            'number_phone' => $request->input('phone_number'),
            'address_1' => $request->input('address_1'),
            'address_2' => $request->input('address_2'),
            'region' => $request->input('region'),
            'city' => $request->input('city'),
            'zipcode' => $request->input('zipcode'),
        ]);

        if ($request->filled('roles')) {
            $user->syncRoles($request->roles);
        }

        if (empty($user->paymentMethod)) {
            $user->paymentMethod()->create(['payment_method_id' => $request->payment_method, 'details' => json_encode($request->fields)]);
        } else {
            $user->paymentMethod->payment_method_id = $request->payment_method;
            $user->paymentMethod->details = json_encode($request->fields);
            $user->paymentMethod->save();
        }
        if ($request->submitter === 'apply') {
            return redirect()->back()->with('success', 'Người dùng <b>' . $user->name . '</b> đã cập nhật thành công..!');
        }
        return redirect()->route('admin.users.index')->with('success', 'Người dùng <b>' . $user->name . '</b> đã cập nhật thành công..!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkFraud($id)
    {
        $user = $this->userRepository->find($id);

        $ipList = DB::table('stu_link_accesses')->pluck('ip_address')->toArray();
        if (empty($ipList)) {
            return response()->json(['message' => 'Không có dữ liệu IP'], 200);
        }

        // Hàm lấy dải mạng (network prefix) từ địa chỉ IP
        $getNetworkPrefix = function ($ip, $prefixLength = 3) {
            $segments = explode('.', $ip);
            return implode('.', array_slice($segments, 0, $prefixLength)); // Lấy 3 phần đầu của IP
        };

        // Tạo mảng lưu các dải mạng và các IP tương ứng
        $networkGroups = [];
        foreach ($ipList as $ip) {
            $networkPrefix = $getNetworkPrefix($ip); // Lấy dải mạng
            if (!isset($networkGroups[$networkPrefix])) {
                $networkGroups[$networkPrefix] = [
                    'count' => 0, // Số lượng IP trong dải mạng
                ];
            }
            $networkGroups[$networkPrefix]['count']++; // Tăng số lượng IP
        }

        // Tính tỷ lệ trùng lặp
        $totalIps = count($ipList);
        $networkGroupsWithPercentage = [];

        foreach ($networkGroups as $networkPrefix => $group) {
            $count = $group['count'];
            $percentage = ($count / $totalIps) * 100; // Tính tỷ lệ phần trăm
            $networkGroupsWithPercentage[$networkPrefix] = [
                'count' => $count,
                'percentage' => round($percentage, 2), // Làm tròn đến 2 chữ số thập phân
            ];
        }

        uasort($networkGroupsWithPercentage, function ($a, $b) {
            return $b['count'] <=> $a['count'];
        });

        $page = request()->get('page', 1);
        $perPage = 10;

        $currentPageItems = array_slice($networkGroupsWithPercentage, ($page - 1) * $perPage, $perPage);
        $paginatedData = new LengthAwarePaginator(
            $currentPageItems,
            count($networkGroupsWithPercentage),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('backend.admin.user.check', compact('totalIps', 'paginatedData', 'user'));

    }
}
