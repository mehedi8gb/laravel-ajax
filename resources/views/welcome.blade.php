@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($crud as $key => $item)
                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
            <button type="button" class="btn btn-sm btn-soft-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item->author->name }} is the author">
               {{ $item->author->name}}
            </button>
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>
                                    {{ $item->created_at }}
                                </td>
                                <td>
                                    {{ $item->updated_at }}
                                </td>
                                <td>
                                    <button onclick="viewData({{ $item->id }})" data-toggle="modal"
                                        data-target="#editModal" class="btn btn-info">edit</button>
                                    <button onclick="Destroy({{ $item->id }})" class="btn btn-danger">delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-3">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="email" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </div>
    @include('edit')
@endsection
@push('script')
    <script>
        $('#submit').click(function(e) {
            e.preventDefault();
            let name = $("[name='name']").val();
            let email = $("[name='email']").val();
            let user_id = {{ Auth::user()->id }};

            $.ajax({
                type: "POST",
                url: "{{ route('crud.store') }}",
                data: {
                    "_token": "{{ @csrf_token() }}",
                    "user_id": user_id,
                    "name": name,
                    "email": email
                },

                success: function(response) {
                    if (response == 0) {
                        alert('Make Sure Payment Status is Paid');
                    }
                    if (response == 1) {
                        onLoad()

                    }
                }
            });

        });

        function Destroy(id) {
            if (confirm("do you want to delete this record?")) {
                $.ajax({
                    type: "DELETE",
                    url: "crud/destroy/" + id,
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        onLoad();
                    }
                });
            }
        };

        function viewData(id) {

            $.ajax({
                type: "GET",
                url: "crud/show/" + id,
                dataType: "json",
                success: function(response) {
                    $('.modal-body').html('');
                    $('.modal-body').append('<div class="modal-body">\
           <form method="post" data-toogle="validator">\
           	@csrf\
            @method('POST ')\
             <div class="form-group">\
             <input type="hidden" name="id" value="' + response.id + '" id="Id">\
               <label for="name">Name</label>\
               <input type="text" class="form-control" value="' + response.name + '" name="name" id="Name" required="" autofocus="">\
             </div>\
             <div class="form-group">\
               <label for="email">Email </label>\
               <input type="text" class="form-control" value="' + response.email + '" name="email" id="Email" required="" autofocus="">\
             </div>\
          </div>');

                }
            });

        };


        function saveData() {
            let id = $("[id='Id']").val();
            let name = $('#Name').val();
            let email = $('#Email').val();
            $.ajax({
                type: "PATCH",
                url: "crud/update/" + id,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                    'name': name,
                    'email': email
                },
                success: function(response) {
                    onLoad()
                }
            });
        }

        function onLoad() {
            let i = 1;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('crud.data') }}",
                success: function(response) {
                    $('.table > tbody').html('');

                    $.each(response, function(key, value) {
                        $('.table > tbody').append('<tr>\
                        <td> ' + i++ + ' </td>\
                        <td> ' + value.name + ' </td>\
                        <td> ' + value.email + ' </td>\
                        <td> ' + value.created_at + ' </td>\
                        <td> ' + value.updated_at + ' </td>\
                        <td>\
                <button data-toggle="modal" data-target="#editModal" onclick="viewData(' + value.id + ')" class="btn btn-info">edit</button>\
                <button onclick="Destroy(' + value.id + ')" class="btn btn-danger">delete</button>\
                            </td>\
                    </tr>');
                    });
                }
            });
        }
    </script>
@endpush
