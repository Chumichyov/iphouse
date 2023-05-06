@extends('layouts.app')
@section('content')
    <div class="p-4 w-100">
        <div class="fs-2 text-blue">
            История
        </div>
        <div class="mt-3">
            @if (count($histories) != 0)
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th class="fs-5" style="width: 150px" scope="col">Дата</th>
                            <th class="fs-5" style="width: 260px" scope="col">Исполнитель</th>
                            <th class="fs-5" style="width: 120px" scope="col">Тип</th>
                            <th class="fs-5" style="width: 250px" scope="col">Партнер</th>
                            <th class="fs-5" style="width: 260px" scope="col">Работник</th>
                            <th class="fs-5" scope="col">Товар</th>
                            <th class="fs-5" style="width: 120px" scope="col">Количество</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                            <tr>
                                <td class="fs-5 ">
                                    {{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y') }}</td>
                                <td class="fs-5 ">{{ $history->user->name . ' ' . $history->user->surname }}</td>
                                <td class="fs-5 ">{{ $history->type->title }}</td>
                                <td class="fs-5 ">{{ isset($history->partner->title) ? $history->partner->title : '' }}
                                </td>
                                <td class="fs-5 ">
                                    {{ isset($history->worker) ? $history->worker->name . ' ' . $history->worker->surname : '' }}
                                </td>
                                <td class="fs-5 ">{{ $history->product->title }}</td>
                                <td class="fs-5 ">{{ $history->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="w-100 text-center fs-1">Транзакции отсутствуют</div>
            @endif

        </div>
    </div>
    @include('examples.errorAndSuccessHandler')
@endsection
