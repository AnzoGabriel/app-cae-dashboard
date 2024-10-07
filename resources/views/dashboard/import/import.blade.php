@extends('layout.app')

@section('title', 'Importação IR')

@section('content')

    <x-navbar-menu />
    <x-sidebar-menu />

    <div class="p-4 sm:ml-64 mt-14">
        <div class="lg:px-60">
            <h1 class="text-center text-gray-900 font-bold text-lg mb-6">Importar Relatório de Alunos com Índice de
                Rendimento e de Faltas</h1>

            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div
                    class="flex flex-col gap-6 px-8 py-12 border rounded-lg p-6 bg-white border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
                    <div>
                        <label for="relatorio-faltas" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            Relatório de Faltas </label>
                        <input
                            class="block w-full text-sm text-blue-900 border border-blue-300 rounded-lg cursor-pointer bg-blue-50 dark:text-blue-400 focus:outline-none dark:bg-blue-700 dark:border-blue-600"
                            aria-describedby="file_input_help" id="relatorio-faltas" type="file" name="relatorio-faltas"
                            accept=".xls">
                        @error('relatorio-faltas')
                            <div class="alert alert-danger text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="relatorio-ir" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            Relatório
                            de Alunos com Índice de Rendimento </label>
                        <input
                            class="block w-full text-sm text-blue-900 border border-blue-300 rounded-lg cursor-pointer bg-blue-50 dark:text-blue-400 focus:outline-none dark:bg-blue-700 dark:border-blue-600"
                            aria-describedby="file_input_help" id="relatorio-ir" type="file" name="relatorio-ir"
                            accept=".xls">
                        @error('relatorio-ir')
                            <div class="alert alert-danger text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex flex-row justify-end">
                        <button type="submit"
                            class="w-1/2 bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300 flex gap-3 justify-center font-bold mt-6"><i
                                class="bi bi-box-arrow-in-right hidden sm:block"></i>
                            Importar Relatórios
                        </button>
                        <div>
                        </div>

            </form>
        </div>
    </div>

@endsection

@push('script')
    <script></script>
@endpush
