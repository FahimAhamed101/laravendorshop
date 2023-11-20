
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('admin/assets') }}/images/favicon-32x32.png" type="image/png" />
	<!-- loader-->
	<link href="{{ asset('admin/assets') }}/css/pace.min.css" rel="stylesheet" />
	<script src="{{ asset('admin/assets') }}/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('admin/assets') }}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('admin/assets') }}/css/app.css" rel="stylesheet">
	<link href="{{ asset('admin/assets') }}/css/icons.css" rel="stylesheet">
	<title>Password Change </title>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-reset-password d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card">
						<div class="row g-0">
							<div class="col-lg-5 border-end">
								<div class="card-body">
									<div class="p-5">
										<div class="text-start">
											<img src="{{ asset('admin/assets') }}/images/logo-img.png" width="180" alt="">
										</div>
										<h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
                                        <form action="{{ route('vendor.password.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3 mt-5">
                                                <label class="form-label">Old Password</label>
                                                <input type="password" name="old_password" class="form-control" placeholder="Enter Old password" />
                                                @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 mt-5">
                                                <label class="form-label">New Password</label>
                                                <input type="password" name="new_password" class="form-control" placeholder="Enter New password" />
                                                @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 mt-5">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" name="con_password" class="form-control" placeholder="Enter Confirm password" />
                                                @error('con_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">Change Password</button> <a href="{{ route('login') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                            </div>
                                        </form>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<img src="{{ asset('admin/assets') }}/images/login-images/forgot-password-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    @include('admin.alert')
	<!-- end wrapper -->
</body>

</html>
