@extends('admin.layout.layout')
@php
    $title='Admin Profile';
    $subTitle = 'Admin Profile';
    $script ='<script>
                    // ======================== Upload Image Start =====================
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $("#imagePreview").css("background-image", "url(" + e.target.result + ")");
                                $("#imagePreview").hide();
                                $("#imagePreview").fadeIn(650);
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $("#imageUpload").change(function() {
                        readURL(this);
                    });
                    // ======================== Upload Image End =====================

                    // ================== Password Show Hide Js Start ==========
                    function initializePasswordToggle(toggleSelector) {
                        $(toggleSelector).on("click", function() {
                            $(this).toggleClass("ri-eye-off-line");
                            var input = $($(this).attr("data-toggle"));
                            if (input.attr("type") === "password") {
                                input.attr("type", "text");
                            } else {
                                input.attr("type", "password");
                            }
                        });
                    }
                    // Call the function
                    initializePasswordToggle(".toggle-password");
                    // ========================= Password Show Hide Js End ===========================
            </script>';
@endphp

@section('content')

            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                    <?php
                    if(empty($vendor->bg_img)){
                        ?> <img src="{{ asset('assets/images/user-grid/NGOBanner.png') }}" alt="" class="w-100 object-fit-cover"> <?php
                    }else{
                        ?> <img src="{{asset('storage/'.$vendor->bg_img)}}" alt="" class="w-100 object-fit-cover"> <?php
                    }
                    ?>
                    <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                            <div class="text-center border border-top-0 border-start-0 border-end-0">
                                <?php
                                if(empty($vendor->profile_img)){
                                    ?> <img src="{{url('/')}}/assets/images/user-list/user.png" alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover"><?php
                                }else{
                                    ?> <img src="{{asset('storage/'.$vendor->profile_img)}}" alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover" ><?php
                                }
                                ?>
                                <h6 class="mb-0 mt-16">{{$vendor->name}}</h6>
                                <span class="text-secondary-light mb-16">{{$vendor->email}}</span>
                            </div>
                            <div class="mt-24">
                                <h6 class="text-xl mb-16">Personal Info</h6>
                                <ul>
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light">Full Name</span>
                                        <span class="w-70 text-secondary-light fw-medium">: {{ $vendor->name }}</span>
                                    </li>
                                   
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> Email</span>
                                        <span class="w-70 text-secondary-light fw-medium" style="font-size:13px;">: {{ $vendor->email }}</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> Phone Number</span>
                                        <span class="w-70 text-secondary-light fw-medium">: {{ $vendor->phone }}</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> PAN No.</span>
                                        <span class="w-70 text-secondary-light fw-medium">: {{ $vendor->pan_num }}</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> Aadhar No.</span>
                                        <span class="w-70 text-secondary-light fw-medium">: {{ $vendor->adhar_num }}</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> Address</span>
                                        <span class="w-70 text-secondary-light fw-medium">: {{ $vendor->address }}</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> City</span>
                                        <span class="w-70 text-secondary-light fw-medium">: {{ $vendor->city }}</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> State</span>
                                        <span class="w-70 text-secondary-light fw-medium">: {{ $vendor->state }}</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> Zipcode</span>
                                        <span class="w-70 text-secondary-light fw-medium">: {{ $vendor->zipcode }}</span>
                                    </li>
                                    
                                    <li class="d-flex align-items-center gap-1">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> Bio</span>
                                        <span class="w-70 text-secondary-light fw-medium">: {{ $vendor->bio }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-body p-24">
                            <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center px-24 active" id="pills-edit-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab" aria-controls="pills-edit-profile" aria-selected="true">
                                        Edit Profile
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab" data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab" aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">
                                        Change Password
                                    </button>
                                </li>
                                <!--<li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center px-24" id="pills-notification-tab" data-bs-toggle="pill" data-bs-target="#pills-notification" type="button" role="tab" aria-controls="pills-notification" aria-selected="false" tabindex="-1">
                                        Notification Settings
                                    </button>
                                </li>-->
                            </ul>

                            <div class="tab-content" id="pills-tabContent">

                                <div class="message">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            
                    <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                     <form action="{{url('/')}}/vendor/update-profile" method="POST" enctype="multipart/form-data">
                                    @csrf              
                    <h6 class="text-md text-primary-light mb-16">Profile Image <span class="text-danger"> (300 Kb)</h6>
                                    <!-- Upload Image Start -->
                                    <div class="mb-24 mt-16">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                                <input type='file' name="profile_img" id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                                                <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                    <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                                </label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div class="avatar-preview">
                                                   
                                                    <?php
                                                    if(empty($vendor->profile_img)){
                                                        ?><div id="imagePreview"> </div> <?php
                                                    }else{
                                                        ?><div><img src="{{ asset('storage/'.$vendor->profile_img) }}"> </div> <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Upload Image End -->
                                    
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name <span class="text-danger-600">*</span></label>
                                                    <input type="text" name="name" value="{{$vendor->name}}" class="form-control radius-8" id="name" placeholder="Enter Full Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                                    <input type="email" name="email" value="{{$vendor->email}}" readonly class="form-control radius-8" id="email" placeholder="Enter email address">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                                                    <input type="text" name="phone" value="{{$vendor->phone}}" class="form-control radius-8" id="number" placeholder="Enter phone number">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="gender" class="form-label fw-semibold text-primary-light text-sm mb-8">Gender <span class="text-danger-600">*</span> </label>
                                                    <select name="gender" class="form-control radius-8 form-select" id="gender">
                                                        <option value=""> Select Gender</option>
                                                        <option value="male" <?php if($vendor->gender=="male"){ echo "selected";} ?>> Male</option>
                                                        <option value="female" <?php if($vendor->gender=="female"){ echo "selected";} ?>>Female </option>
                                                        <option value="other" <?php if($vendor->gender=="other"){ echo "selected";} ?>> other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="pannumber" class="form-label fw-semibold text-primary-light text-sm mb-8">PAN NO.</label>
                                                    <input type="text" name="pan_num" value="{{$vendor->pan_num}}" class="form-control radius-8" id="pannumber" placeholder="Enter PAN number">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="aadharnumber" class="form-label fw-semibold text-primary-light text-sm mb-8">Aadhar NO.</label>
                                                    <input type="text" name="adhar_num" value="{{$vendor->adhar_num}}" class="form-control radius-8" id="aadharnumber" placeholder="Enter Aadhar number">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="address" class="form-label fw-semibold text-primary-light text-sm mb-8">Address</label>
                                                    <input type="text" name="address" value="{{$vendor->address}}" class="form-control radius-8" id="address" placeholder="Enter Address">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="city" class="form-label fw-semibold text-primary-light text-sm mb-8">City</label>
                                                    <input type="text" name="city" value="{{$vendor->city}}" class="form-control radius-8" id="city" placeholder="Enter City">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="state" class="form-label fw-semibold text-primary-light text-sm mb-8">State</label>
                                                    <input type="text" name="state" value="{{$vendor->state}}" class="form-control radius-8" id="state" placeholder="Enter State">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="zipcode" class="form-label fw-semibold text-primary-light text-sm mb-8">Zipcode</label>
                                                    <input type="text" name="zipcode" value="{{$vendor->zipcode}}" class="form-control radius-8" id="zipcode" placeholder="Enter Zipcode">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="panimg" class="form-label fw-semibold text-primary-light text-sm mb-8">PAN Card Image <span class="text-danger"> (500 Kb)</label>
                                                    <input type="file" name="pan_img" class="form-control radius-8" id="panimg" >
                                                    {{-- PAN --}}
                                                    @if($vendor->pan_img)
                                                        <img src="{{ route('vendor.pan', basename($vendor->pan_img)) }}" style="width:100px;">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="adharimg" class="form-label fw-semibold text-primary-light text-sm mb-8">Aadhar Image <span class="text-danger"> (500 Kb)<span></label>
                                                    <input type="file" name="adhar_img"  class="form-control radius-8" id="adharimg" >
                                                    {{-- Aadhaar --}}
                                                    @if($vendor->adhar_img)
                                                        <img src="{{ route('vendor.adhar', basename($vendor->adhar_img)) }}" style="width:100px;">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="pbimg" class="form-label fw-semibold text-primary-light text-sm mb-8">Profile Background Banner<span class="text-danger"> (360 * 120px)<span></label>
                                                    <input type="file" name="bg_img"  class="form-control radius-8" id="pbimg" >
                                                    {{-- Background Banner --}}
                                                    @if($vendor->bg_img)
                                                        <img src="{{ asset('storage/'.$vendor->bg_img) }}" style="width:100px;">
                                                    @endif
                                                </div>
                                            </div>


                                           
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description <span class="text-danger"> (500)<span></label>
                                                    <textarea name="bio" class="form-control radius-8" id="desc" placeholder="Write description...">{{$vendor->bio}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center gap-3">
                                            <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                                Cancel
                                            </button>
                                            <button type="text" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            
                       
        <div class="tab-pane fade" id="pills-change-passwork" role="tabpanel" aria-labelledby="pills-change-passwork-tab" tabindex="0">
            <form action="{{url('/')}}/vendor/update-password" method="post">     
                @csrf
                <div class="mb-20">
                    <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">New Password <span class="text-danger"> (Minimum 6 digit) </span><span class="text-danger-600">*</span></label>
                    <div class="position-relative">
                        <input type="password" name="password" class="form-control radius-8" id="your-password" placeholder="Enter New Password*" required>
                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                    </div>
                </div>
                <div class="mb-20">
                    <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmed Password <span class="text-danger-600">*</span></label>
                    <div class="position-relative">
                        <input type="password" name="password_confirmation"  class="form-control radius-8" id="confirm-password" placeholder="Confirm Password*" required>
                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                    Update
                </button>
            </form>
        </div>
        

                                <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab" tabindex="0">
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="companzNew" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Company News</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="companzNew">
                                        </div>
                                    </div>
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="pushNotifcation" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Push Notification</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="pushNotifcation" checked>
                                        </div>
                                    </div>
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="weeklyLetters" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Weekly News Letters</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="weeklyLetters" checked>
                                        </div>
                                    </div>
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="meetUp" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Meetups Near you</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="meetUp">
                                        </div>
                                    </div>
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="orderNotification" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Orders Notifications</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="orderNotification" checked>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
