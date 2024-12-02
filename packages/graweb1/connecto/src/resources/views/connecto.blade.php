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
                                    <th scope="col">ACTIONS</th>
                                </tr>
                            </thead>
                            @if ($db1)
                                <tbody class="table-group-divider">
                                    @foreach ($db1['tables'] as $table)
                                        <tr>
                                            <td class="col-md-3">{{ $table['table_name'] }}</td>
                                            <td class="col-md-2 text-center">{{ $table['total_records'] }}</td>
                                            <td class="col-md-1 text-center">{{ $table['size_mb'] }} mb</td>
                                            <td class="col-md-1 text-center">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#modalTransferData"
                                                    data-bs-whatever="{{ $db2['database_name'] }}"
                                                    onclick="fetchTableColumns('{{ $db1['database_name'] }}', '{{ $table['table_name'] }}')">
                                                    <i class="bi bi-caret-right-fill"></i>
                                                </button>
                                            </td>
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
                                    <th scope="col">ACTIONS</th>
                                </tr>
                            </thead>
                            @if ($db2)
                                <tbody class="table-group-divider">
                                    @foreach ($db2['tables'] as $table)
                                        <tr>
                                            <td class="col-md-3">{{ $table['table_name'] }}</td>
                                            <td class="col-md-2 text-center">{{ $table['total_records'] }}</td>
                                            <td class="col-md-1 text-center">{{ $table['size_mb'] }} mb</td>
                                            <td class="col-md-1 text-center">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#modalTransferData"
                                                    data-bs-whatever="{{ $db1['database_name'] }}"
                                                    onclick="fetchTableColumns('{{ $db2['database_name'] }}', '{{ $table['table_name'] }}')">
                                                    <i class="bi bi-caret-left-fill"></i>
                                                </button>
                                            </td>
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

    <!-- Modal transfer data -->
    <div class="modal fade" id="modalTransferData" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Transfer data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="table-name" class="col-form-label">Table:</label>
                            <input type="text" class="form-control" id="table-name" name="table-name">
                        </div>
                        <div class="mb-3">
                            <table class="table table-hover table-bordered table-sm" id="columnsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAllCheckbox" class="form-check-input">
                                        </th>
                                        <th>COLUMN</th>
                                        <th>TYPE</th>
                                        <th>AUTO INCREMENT</th>
                                        <th>PRIMARY KEY</th>
                                        <th>NULLABLE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Linhas preenchidas dinamicamente -->
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-primary">Send data</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const transferDataModal = document.getElementById('modalTransferData')
        if (transferDataModal) {
            transferDataModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const recipient = button.getAttribute('data-bs-whatever');
                const modalTitle = transferDataModal.querySelector('.modal-title');
                const modalBodyInput = transferDataModal.querySelector('.modal-body input');

                modalTitle.textContent = `Transfer data to ${recipient}`;
                modalBodyInput.value = recipient;
            });
        };

        document.querySelector('.btn-outline-primary').addEventListener('click', function() {
            const selectedColumns = [];
            $('input[name="columns[]"]:checked').each(function() {
                selectedColumns.push($(this).val());
            });

            if (selectedColumns.length > 0) {
                $.ajax({
                    url: '/connecto/transfer_data',
                    type: 'POST',
                    data: {
                        selected_columns: selectedColumns,
                        source_database: sourceDatabaseName,
                        target_database: targetDatabaseName,
                    },
                    success: function(response) {
                        alert('Data transferred successfully!');
                    },
                    error: function(error) {
                        console.error('Error during data transfer:', error);
                    }
                });
            } else {
                alert('Please select at least one column to transfer.');
            }
        });

        function fetchTableColumns(databaseName, tableName) {
            $.ajax({
                url: `/connecto/table_columns`,
                type: 'GET',
                data: {
                    database: databaseName,
                    table: tableName,
                },
                success: function(data) {
                    let tbody = $('#columnsTable tbody');
                    tbody.empty();
                    data.forEach(function(column) {
                        tbody.append(`
                    <tr>
                        <td><input type="checkbox" class="form-check-input" name="columns[]" value="${column.name}"></td>
                        <td>${column.name}</td>
                        <td>${column.type}</td>
                        <td>${column.auto_increment}</td>
                        <td>${column.primary_key}</td>
                        <td>${column.nullable ? 'Yes' : 'No'}</td>
                    </tr>
                `);
                    });

                    // Evento de clique na linha para alternar o checkbox
                    $('#columnsTable tbody tr').on('click', function(event) {
                        // Verifica se o clique foi no checkbox ou na linha inteira
                        if (event.target.type !== 'checkbox') {
                            let checkbox = $(this).find('input[type="checkbox"]');
                            checkbox.prop('checked', !checkbox.prop('checked'));
                        }
                        updateSelectAllCheckboxState();
                    });

                    // Evento para selecionar/desmarcar todos os checkboxes
                    $('#selectAllCheckbox').on('change', function() {
                        let isChecked = $(this).prop('checked');
                        $('#columnsTable tbody input[type="checkbox"]').prop('checked', isChecked);
                    });

                    // Atualizar estado do "select all" ao carregar a tabela
                    updateSelectAllCheckboxState();
                },
                error: function(error) {
                    console.error("Erro ao buscar colunas:", error);
                }
            });
        }

        // Função para atualizar o estado do checkbox "select all" no cabeçalho
        function updateSelectAllCheckboxState() {
            let totalCheckboxes = $('#columnsTable tbody input[type="checkbox"]').length;
            let checkedCheckboxes = $('#columnsTable tbody input[type="checkbox"]:checked').length;

            // Se todos os checkboxes estiverem marcados, marque o checkbox de "select all"
            if (totalCheckboxes === checkedCheckboxes) {
                $('#selectAllCheckbox').prop('checked', true);
            } else {
                $('#selectAllCheckbox').prop('checked', false);
            }
        }
    </script>
</body>

</html>
