<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Score List - Score.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Nilai Para Siswa Untuk Setiap Mata Pelajaran</h3>
                    <h5 class="text-center"><a href="https://Score.com">www.Score.com</a></h5>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('scores.create') }}" class="btn btn-md btn-success mb-3">ADD NILAI</a>
                        <table class="table table-bordered">
                            <thead>
                        
                            <tr>
                                    
                                   
                                    <th scope="col">IPA</th>
                                    <th scope="col">IPS</th>
                                    <th scope="col">Matematika</th>
                                    <th scope="col">Bahasa Indonesia</th>
                                    <th scope="col">Bahasa Inggris</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($scores as $score)
                                    <tr>
                                        
                                      
                                        <td>{{ $score->ipa }}</td>
                                        <td>{{ $score->ips }}</td>
                                        <td>{{ $score->mtk }}</td>
                                        <td>{{ $score->bindo }}</td>    
                                        <td>{{ $score->bing }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('scores.destroy', $score->id) }}" method="POST">
                                                <a href="{{ route('scores.show', $score->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('scores.edit', $score->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Nilai Belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $scores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>

</body>
</html>                     