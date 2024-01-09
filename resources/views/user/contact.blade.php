@extends('user.layout.app')
@section('nav_contact_active', 'active')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Contact</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger" id="name_error"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Your Email" required="required"
                                data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger" id="email_error"></p>
                        </div>
                        <div class="control-group">
                            <input type="number" name="phone" class="form-control" id="phone"
                                placeholder="Your Phone Number" required="required"
                                data-validation-required-message="Please enter your phone" />
                            <p class="help-block text-danger" id="phone_error"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" name="message" rows="8" id="message" placeholder="Message" required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger" id="message_error"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d954.5542102506969!2d96.13999059733428!3d16.86516457866215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c19488609153b5%3A0xee873d9951fb1a0a!2sJunction%208!5e0!3m2!1sen!2smm!4v1704542694440!5m2!1sen!2smm"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, Yangon, MYANMAR</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#sendMessageButton').on('click', function(e) {
                e.preventDefault();
                const name = $('#name').val();
                const email = $('#email').val();
                const phone = $('#phone').val();
                const message = $('#message').val();

                $.ajax({
                    url: '/ajax/send_message',
                    type: 'get',
                    data: {
                        'name': name,
                        'email': email,
                        'phone': phone,
                        'message': message
                    },
                    success: function(response) {
                        if (response.status == 'fail') {
                            response.data.email ? $('#name_error').text(response.data.email[
                                0]) : $('#name_error').text('');
                            response.data.email ? $('#email_error').text(response.data.email[
                                0]) : $('#email_error').text('');
                            response.data.email ? $('#phone_error').text(response.data.email[
                                0]) : $('#phone_error').text('');
                            response.data.email ? $('#message_error').text(response.data.email[
                                0]) : $('#message_error').text('');
                        }
                        if (response.status == 'success') {
                            $('#name').val('');
                            $('#email').val('');
                            $('#phone').val('');
                            $('#message').val('');
                            const message = response.message;
                            Toast.fire({
                                icon: "success",
                                title: message
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
