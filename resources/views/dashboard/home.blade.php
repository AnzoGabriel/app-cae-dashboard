@extends('layout.app')

@section('title', 'Dados da planilha')

@section('content')

    <x-navbar-menu />
    <x-sidebar-menu />
   <div class="p-4 sm:ml-64 mt-14">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-blue-500 text-white">
                    @foreach ($header_formatter[0] as $header)
                        <th class="py-3 px-6 text-left font-semibold uppercase tracking-wider">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data_formatter as $row)
                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                        @foreach ($row as $cell)
                            <td class="py-3 px-6">{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection