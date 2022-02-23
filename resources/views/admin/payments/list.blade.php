@extends('admin.layouts.main')

@section('title')
    {{ __('Payments') }}
@endsection

@section('content')
    <div class="container-fluid pr-2 pl-2" style="padding: 0 20px!important">
        <table class="table table-striped table-bordered datatable">
            <thead>
            <tr>
                <th>{{ __('Id') }}</th>
                <th>{{ __('User') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Devices') }}</th>
                <th>{{ __('Events') }}</th>
                <th>{{ __('Months') }}</th>
                <th>{{ __('Cost') }}</th>
                <th>{{ __('Buy date') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $index => $payment)
                <tr>
                    <td>{{$payment->id}}</td>
                    <td>{{\App\Models\User::firstWhere('id', $payment->user_id)->name}}</td>
                    <td>{{\App\Models\User::firstWhere('id', $payment->user_id)->email}}</td>
                    <td>{{$payment->type}}</td>
                    <td>{{$payment->devices}}</td>
                    <td>{{$payment->events}}</td>
                    <td>{{$payment->months}}</td>
                    <td>{{$payment->cost}}</td>
                    <td>{{\App\Helper\Helper::dateFromDatetime($payment->created_at)}}</td>
                    <td>
                        <button type="button" class="btn btn-danger delete-payment-btn"
                                data-id="{{ $payment->id }}"
                                data-toggle="modal" data-target="#DeleteModal">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>{{ __('Id') }}</th>
                <th>{{ __('User') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Devices') }}</th>
                <th>{{ __('Events') }}</th>
                <th>{{ __('Months') }}</th>
                <th>{{ __('Cost') }}</th>
                <th>{{ __('Buy date') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
            </tfoot>
        </table>
        <div class="loader" style="display: none"></div>
    </div>

    <!-- Delete modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        Delete payment</h5>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to delete this payment?
                </div>
                <div class="modal-footer">
                    <form class="delete-form col-12" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Yes
                        </button>
                        <button type="button" class="btn btn-primary"
                                data-dismiss="modal" aria-label="Close">
                            No
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('.datatable').DataTable({
                "paging": true,
                "processing" : true,
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
            });
        });

        $('.delete-payment-btn').on('click', function () {
            let id = $(this).attr('data-id');
            $('.delete-form').attr('action', '{{ route('admin.payment.delete') }}?id=' + id);
        });
    </script>
@endsection
