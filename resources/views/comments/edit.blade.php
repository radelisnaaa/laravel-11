!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Comments - CommentBerita.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

<div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('comments.update', $comment->id) }}" method="POST" enctype="multipart/form-data">
                        
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        
                        <div class="from-group mb-3">
                            <label class="font-weight-bold">Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">  
                        
                            <!-- error message untuk photo -->
                            @error('photo')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama">
                            <!-- error message untuk nama -->
                            @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                            <!-- error message untuk email -->
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone">
                            <!-- error message untuk phone -->
                            @error('phone')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Review</label>
                            <textarea class="form-control @error('review') is-invalid @enderror" name="review" rows="5"></textarea>
                            <!-- error message untuk review -->
                            @error('review')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        <button type="submit" class="btn btn-md btn-primary">UPDATE COMMENT</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'review' );
    </script>
</body>
</html>

                            