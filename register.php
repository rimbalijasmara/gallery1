<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-grid.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="signup-form">
                    <form action="proses_register.php" method="POST"class="mt-5 border p-4 bg-light shadow">
                        <h4 class="mb-5 text-secondary">Create Your Account</h4>
                        <div class="row">
                            
                            <div class="mb-3 col-md-12">
                                <label>Username<span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label>Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label>Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" name="namalengkap" class="form-control" placeholder="Masukan Nama Lengkap" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label>Alamat<span class="text-danger">*</span></label>
                                <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" required>
                            </div>
                            <div class="col-md-12">
                               <button class="btn btn-primary float-end" value="Register">Daftar</button>
                            </div>
                        </div>
                    </form>
                    <p class="text-center mt-3 text-secondary">Sudah Punya Akun?<a href="login.php">Login Sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
    
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
</body>
</html>