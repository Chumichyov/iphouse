@extends('layouts.app')
@section('content')
    <div class="container w-100">
        <div class="d-flex align-items-center justify-content-between">
            <div class="fs-2 text-blue">
                Сотрудники
            </div>
        </div>
        <div class="mt-3">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th class="fs-5" style="width: 250px" scope="col">Имя</th>
                        <th class="fs-5" style="width: 350px" scope="col">Фамилия</th>
                        <th class="fs-5" scope="col">Почта</th>
                        <th class="fs-5" style="width: 160px" scope="col">Роль</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="position-relative">
                            <td class="fs-5">
                                {{ $user->name }}
                                {{-- <a href="{{ route('product.show', ['product' => $product->id]) }}"
                                    class="position-absolute top-0 bottom-0 start-0 end-0"></a> --}}
                            </td>
                            <td class="fs-5">{{ $user->surname }}</td>
                            <td class="fs-5">{{ $user->email }}</td>
                            <td class="fs-5">{{ $user->role->title }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 d-flex align-items-center justify-content-between">
            <div class="fs-2 text-blue">
                Запросы на регистрацию
            </div>
        </div>
        <div class="mt-3">
            @if (count($preRegistration) > 0)
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th class="fs-5" style="width: 250px" scope="col">Имя</th>
                            <th class="fs-5" style="width: 350px" scope="col">Фамилия</th>
                            <th class="fs-5" scope="col">Почта</th>
                            <th class="fs-5" style="width: 100px" scope="col"></th>
                            <th class="fs-5" style="width: 100px" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preRegistration as $user)
                            <tr class="position-relative">
                                <td class="fs-5">
                                    {{ $user->name }}
                                    {{-- <a href="{{ route('product.show', ['product' => $product->id]) }}"
                                    class="position-absolute top-0 bottom-0 start-0 end-0"></a> --}}
                                </td>
                                <td class="fs-5">{{ $user->surname }}</td>
                                <td class="fs-5">{{ $user->email }}</td>
                                <td class="fs-5">
                                    <form action="{{ route('personal.update', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="btn btn-primary background-blue">Добавить</button>
                                    </form>
                                </td>
                                <td class="fs-5">
                                    <form action="{{ route('personal.destroy', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Отклонить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="mt-4 w-100 text-center fs-1">Запросы отсутствуют</div>
            @endif

        </div>
    </div>
    @include('examples.errorAndSuccessHandler')
@endsection
