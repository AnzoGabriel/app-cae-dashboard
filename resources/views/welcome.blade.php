@extends('layout.app')

@section('title', 'Welcome')

@section('content')

    <x-navbar-menu />
    <x-sidebar-menu />

    <div class="p-4 sm:ml-64 mt-14">
        <div class="lg:px-60">
            <h1 class="text-center text-gray-900 font-bold text-lg mb-6">Importar Relatório de Alunos com Índice de Rendimento</h1>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div
                    class="flex flex-col items-center px-8 py-12 border rounded-lg p-6 bg-white border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
                    <input
                        class="block w-full text-sm text-blue-900 border border-blue-300 rounded-lg cursor-pointer bg-blue-50 dark:text-blue-400 focus:outline-none dark:bg-blue-700 dark:border-blue-600"
                        aria-describedby="file_input_help" id="file-upload" type="file" name="file" accept=".xls">


                    <button type="submit"
                        class="w-1/2 bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300 flex gap-3 justify-center font-bold mt-6"><i
                            class="bi bi-box-arrow-in-right hidden sm:block"></i>
                        Importar Relatório
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection

@push('script')
    <script></script>
@endpush
