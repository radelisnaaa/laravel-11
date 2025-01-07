<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Score - Score.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('scores.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Ilmu Pengetahuan Alam</label>
                                <input type="number" class="form-control @error('ipa') is-invalid @enderror" name="ipa" value="{{ old('ipa') }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk ipa -->
                                @error('ipa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Ilmu Pengetahuan Sosial</label>
                                <input type="number" class="form-control @error('ips') is-invalid @enderror" name="ips" value="{{ old('ips') }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk ips -->
                                @error('ips')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Matematika</label>
                                <input type="number" class="form-control @error('mtk') is-invalid @enderror" name="mtk" value="{{ old('mtk') }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk mtk -->
                                @error('mtk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Bahasa Indonesia</label>
                                <input type="number" class="form-control @error('bindo') is-invalid @enderror" name="bindo" value="{{ old('bindo') }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk bindo -->
                                @error('bindo')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Bahasa Inggris</label>
                                <input type="number" class="form-control @error('bing') is-invalid @enderror" name="bing" value="{{ old('bing') }}" placeholder="Masukkan Nilai">
                            
                                <!-- error message untuk bing -->
                                @error('bing')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

</body>
</html>