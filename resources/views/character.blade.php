<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset("CSS/style.css") }}" rel="stylesheet">
    <title>Consumir Api Rick Y Morty</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&amp;display=swap" rel="stylesheet">
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>

<body>
    <section>
        <div class="container">
            <h1 class="text-center fs-2 fw-bold p-5"> API RICK Y MORTY </h1>
            <button class="btn btn-success" id="savebd">Save Data Base</button>
            <div class="table-responsive">
                <table id="RMApi" class="table table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Species</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody id="TbodyRMApi">

                    </tbody>
                </table>
            </div>
            <nav class="pagination-container">

                <div id="pagination-numbers">

                </div>
            </nav>
        </div>

    </section>
    <section>
        <div class="container  mt-5">
            <h1 class="text-center fs-2 fw-bold p-5"> DATABASE RICK Y MORTY </h1>
            <table id="RMdata"class="table table-sm table-hovermb-5">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Species</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($charactedb as $data)
                    <tr>
                        <th scope="row">{{ $data->id_api }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->species }}</td>
                        <td><button ide="{{ $data->id_api }}"class=" editdetails btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">

                {!! $charactedb->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>

    </section>
    @include('Modals.detail')
    @include('Modals.edit')
</body>

</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset("js/Api.js")}}"></script>
