<div class="row row-deck row-cards">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Bộ lọc</h3>
      </div>
      <div class="card-body">
          
          <form class="row justify-content-between">
            <input id="start_date" name="start_date" hidden/>
            <input id="end_date" name="end_date" hidden/>

        
            <div class="col-12 col-md-3 mb-3">
              <label class="form-label required">Datetime</label>

              <div class="input-icon">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                </span>
                <input class="form-control" placeholder="" id="datepicker-filter"/>
              </div>
            </div>
            <div class="col-12 col-md-3 mb-3">
              <label class="form-label required">Group</label>
              <select class="form-control" name="group_by" autoselection value="{{ request()->query('group_by') }}" required>
                <option value="">[--Select group--]</option>
                {{-- <option value="date">Ngày</option> --}}
                <option value="identifier">Mã ĐD</option>
                <option value="ip_address">Địa chỉ IP</option>
                <option value="referral">Giới thiệu</option>
                <option value="country">Quốc gia</option>
                <option value="browser">Trình duyệt</option>
                <option value="platform">Hệ điều hành</option>
                <option value="device">Thiết bị</option>
                <option value="detection">VPN/PROXY</option>
              </select>
            </div>
            <div class="col-12 col-md-3 mb-3">
              <label class="form-label required">Order</label>
              <select class="form-control" autoselection value="{{ request()->query('order_by') }}" name="order_by" required>
                <option value="">[--Select order--]</option>
                <option value="count" selected>Phần trăm</option>
                <option value="revenue">Doanh thu</option>
                <option value="label">Tên label</option>
                <option value="count">Lượt truy cập</option>
              </select>
            </div>
            <div class="col-12 col-md-3 mb-3">
              <label class="form-label required">Order method</label>
              <select class="form-control" autoselection value="{{ request()->query('order_method') }}" name="order_method" required>
                <option value="">[--Select order method--]</option>
                <option value="asc">Tăng dần (ASC)</option>
                <option value="desc" selected>Giảm dần (DESC)</option>
              </select>
            </div>
            <div class="col-12 col-md-4">
              <input type="submit" value="Lọc" class="btn btn-primary">
              <input type="button" value="Đặt lại" class="button auto flex btn btn-w-m btn-default" onclick="(location.href = location.pathname)">
            </div>
          </form>
      </div>
    </div>
  </div>


    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Access</h3>
            </div>
            <div class="table-responsive">
            <table class="table table-vcenter">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Percent</th>
                        <th>Revenue</th>
                        <th class="text-end">Visitors</th>
                    </tr>
                </thead>
                <tbody>
                  @if (count($linkData['referral']))
                  @foreach ($linkData['referral'] as $key=>$val)
                  @php
                      $per = round($val->count*100/($linkData['referral']->sum), 2);
                  @endphp
                  <tr>
                      <td>
                          <div class="progressbg">
                          <div class="progress progressbg-progress">
                              <div class="progress-bar bg-primary-lt" style="width: {{ $per }}%" role="progressbar" aria-valuenow="{{ $per }}" aria-valuemin="0" aria-valuemax="100">
                              </div>
                          </div>
                          <div class="progressbg-text">{{ $val->label }}</div>
                          </div>
                      </td>
                      <td class="fw-bold">{{ $per }}%</td>
                      <td class="fw-bold">${{ round($val->revenue, 3) }}</td>
                      <td class="w-1 fw-bold text-end">{{ $val->count }}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="20">
                      KHÔNG CÓ DỮ LIỆU
                    </td>
                </tr>
                  @endif
                </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
            
                {{ $linkData['referral']->links('pagination.tabler') }}

              </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">Report</h3>
          </div>
          <div class="table-responsive">
          <table class="table table-vcenter">
              <thead>
                  <tr>
                      <th>Ngày</th>
                      <th>Lượt xem</th>
                      <th>Doanh thu</th>
                      <th class="text-end">CPM</th>
                  </tr>
              </thead>
              <tbody>
                @if (count($linkData['paginatedSTUStats']))
                @foreach ($linkData['paginatedSTUStats'] as $key=>$val)

                <tr>
                    <td>
                      {{ $val->date }}
                    </td>
                    <td>
                      {{ $val->clicks }}
                    </td>
                    <td>
                      ${{ round_revenue($val->revenue) }}
                    </td>
                    <td class="text-end">
                      ${{ round_revenue($val->revenue*1000) }}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="20">
                    KHÔNG CÓ DỮ LIỆU
                  </td>
              </tr>
                @endif
              </tbody>
              </table>
          </div>
          <div class="card-footer d-flex align-items-center">
          
              {{ $linkData['paginatedSTUStats']->links('pagination.tabler') }}

            </div>
      </div>
  </div>
</div>

<script>
  // @formatter:off
  document.addEventListener("DOMContentLoaded", function () {
    function dateYYYYMMDD(date) {
      return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;
    }

    const today = new Date();
    const startDateElt = document.getElementById('start_date').value;
    const endDateElt = document.getElementById('end_date').value;

    const startDate = startDateElt || dateYYYYMMDD(new Date(today.getFullYear(), today.getMonth(), 1));
    const endDate = endDateElt || dateYYYYMMDD(today);
    
    window.Litepicker && (new Litepicker({
      element: document.getElementById('datepicker-filter'),
      autoApply: false,
      singleMode: false,
      buttonText: {
        apply: "Áp dụng",
        cancel: "Huỷ",
        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
      },
      plugins: ['keyboardnav', 'mobilefriendly', 'ranges'],
      ranges: {
        customRangesLabels: ["Hôm nay", "Hôm qua", "7 ngày qua", "30 ngày qua", "Tháng này", "Tháng trước", "Toàn thời gian"],
        startAllTime: new Date("{{ $linkData['data']->created_at}}")
      },
      startDate: startDate,
      endDate: endDate,
      format: 'YYYY/M/D',
      setup: (picker) => {
        picker.on('button:apply', (start, end) => {
          const startDateSelected = start.format('YYYY-MM-DD');
          const endDateSelected = end.format('YYYY-MM-DD');

          document.getElementById('start_date').value = startDateSelected;
          document.getElementById('end_date').value = endDateSelected;

        });
      },
      lang: 'vi'
    }));
  });
  // @formatter:on
</script>