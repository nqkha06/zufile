@extends('layouts.clients.home_layout')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/7.5.0/css/flag-icons.min.css" integrity="sha512-+WVTaUIzUw5LFzqIqXOT3JVAc5SrMuvHm230I9QAZa6s+QRk8NDPswbHo2miIZj3yiFyV9lAgzO1wVrjdoO4tw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endpush
@section('content')
    <main class="bg-white px-6 py-20 sm:py-24 lg:px-8 border-b">
        <div class="prose mx-auto">
            <header class="text-center">
                <h1>Payout Rates</h1>
            </header>
            <div class="not-prose text-center">
                <p>We pay to all visitors in any country. we count 1 ip address for 1 view in 24 hours.</p>
                <p>Traffic quality affects the CPM rate, the better the quality of traffic, the higher CPM gets a few
                    percent of
                    the CPM price mentioned below. Similarly, if the quality of traffic is not good, CPM can be reduced by a
                    few
                    percent from the CPM price mentioned below.</p>
                {{-- <p>Last update at Feb 3, 2021 at 05:18.</p> --}}
            </div>
            <table class="table-line">
                <thead>
                    <tr>
                        <th scope="col">Country</th>
                        <th scope="col">Rates<span class="text-gray-500">/1000</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @if ($level->rates->count() > 0)

                        @foreach ($level->rates as $rate)
                            <tr>
                                <td class="text-gray-900">
                                    <span class="fi fi-{{ strtolower($rate->country?->abv) }} shadow rounded"></span>
                                    {{ $rate->country?->name }}
                                </td>
                                <td class="text-gray-500">${{ $rate->rate[0] }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-gray-900" colspan="2">No payout rates available.</td>
                        </tr>

                    @endif

                </tbody>
            </table>
        </div>

    </main>
@endsection
