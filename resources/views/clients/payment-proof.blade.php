@extends('layouts.clients.home_layout')

@section('content')
    <main class="bg-white px-6 py-20 sm:py-24 lg:px-8 border-b">
        <article class="prose mx-auto">
    <header class="text-center">
        <h1>Payment Proof</h1>
    </header>

    <table>
        <tbody>
            @if ($invoices->isEmpty())
                <tr>
                    <td colspan="2" class="text-center text-gray-500">No payment proof available.</td>
                </tr>
            @else
            @php
    function maskName($name) {
        // return $name;

        $fixedLength = 8;
        $name = trim($name);
        $visible = mb_substr($name, 0, 2);
        $masked = str_repeat('*', max(0, $fixedLength - mb_strlen($visible)));

        return $visible . $masked;
    }
@endphp
                @foreach ($invoices as $invoice)
                    <tr>
                <td>
                    <div class="text-sm font-medium leading-6 text-gray-900">{{ maskName($invoice->user->name) }}</div>
                    <div class="text-xs leading-5 text-gray-500">{{ $invoice->created_at->format('d M Y, h:i A') }}</div>
                </td>
                <td>
                    <div class="text-sm leading-6 text-gray-900">{{ $invoice->payment_method }}</div>
                    <div>{{ currencyFormat($invoice->amount) }}</div>
                </td>
            </tr>
                @endforeach

            @endif
        </tbody>
    </table>

    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        @if ($invoices->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                &laquo; Previous
            </span>
        @else
            <a href="{{ $invoices->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                &laquo; Previous
            </a>
        @endif

        @if ($invoices->hasMorePages())
            <a href="{{ $invoices->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                Next &raquo;
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                Next &raquo;
            </span>
        @endif
    </nav>

</article>
    </main>
@endsection
