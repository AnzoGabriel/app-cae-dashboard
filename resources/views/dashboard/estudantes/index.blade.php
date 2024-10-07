@extends('layout.app')

@section('title', 'Estudantes')

@section('content')

    <x-navbar-menu />
    <x-sidebar-menu />
    <div class="p-4 sm:ml-64 mt-14">
        <table id="search-table" class="bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-3 px-6 text-left font-semibold uppercase tracking-wider">Nº de Matrícula</th>
                    <th class="py-3 px-6 text-left font-semibold uppercase tracking-wider">Nome</th>
                    <th class="py-3 px-6 text-left font-semibold uppercase tracking-wider">Email Estudantil</th>
                    <th class="py-3 px-6 text-left font-semibold uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudantes as $estudante)
                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                        <td class="py-3 px-6">{{ $estudante->num_matricula }}</td>
                        <td class="py-3 px-6">{{ $estudante->nome }}</td>
                        <td class="py-3 px-6">{{ $estudante->email_estudantil }}</td>
                        <td class="py-3 px-6"><a href="{{ route('estudantes.rendimentos', $estudante->num_matricula) }}"
                                class="px-3 py-2 text-xs font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Ver
                                Rendimento</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script type="module">
        if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#search-table", {
        searchable: true,
        sortable: false
    });
}
    </script>
@endpush
