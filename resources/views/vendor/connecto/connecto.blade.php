<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        /* Define altura responsiva para o card-body */
        .card-body {
            max-height: 90vh;
            /* 50% da altura da tela */
            overflow-y: auto;
        }

        @media (max-width: 768px) {
            .card-body {
                max-height: 70vh;
                /* Ajuste para telas menores */
            }
        }

        @media (max-width: 576px) {
            .card-body {
                max-height: 50vh;
                /* Ajuste para telas muito pequenas */
            }
        }
    </style>
</head>

<body>
    <main class="container-fluid pt-3">
        <div class="row">
            <!-- Primeira tabela à esquerda -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $db1['database_name'] ?? 'No database has been configured' }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">NAME</th>
                                    <th scope="col">TOTAL RECORDS</th>
                                    <th scope="col">SIZE</th>
                                </tr>
                            </thead>
                            @if ($db1)
                                <tbody class="table-group-divider">
                                    @foreach ($db1['tables'] as $table)
                                        <tr>
                                            <td class="col-md-3">{{ $table['table_name'] }}</td>
                                            <td class="col-md-2 text-center">{{ $table['total_records'] }}</td>
                                            <td class="col-md-1 text-center">{{ $table['size_mb'] }} mb</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td class="text-center" colspan="4">no records</td>
                                    </tr>
                                </tbody>
                            @endif

                        </table>
                    </div>
                </div>
            </div>

            <!-- Segunda tabela à direita -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $db2['database_name'] ?? 'No database has been configured' }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">NAME</th>
                                    <th scope="col">TOTAL RECORDS</th>
                                    <th scope="col">SIZE</th>
                                </tr>
                            </thead>
                            @if ($db2)
                                <tbody class="table-group-divider">
                                    @foreach ($db2['tables'] as $table)
                                        <tr>
                                            <td class="col-md-3">{{ $table['table_name'] }}</td>
                                            <td class="col-md-2 text-center">{{ $table['total_records'] }}</td>
                                            <td class="col-md-1 text-center">{{ $table['size_mb'] }} mb</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td class="text-center" colspan="4">no records</td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
