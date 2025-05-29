@extends('user.layout.master')
@section('title', 'Dashboard')
@section('content')
    <h1>Reservation History </h1>
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <section class="mb-8">
                                <h2 class="text-2xl font-semibold text-gray-700">Project Overview</h2>
                                <p class="text-gray-600 mb-4">
                                    This platform is designed to create a seamless and efficient way for students within a single student dormitory to manage bicycle reservations. Our goal is to maximize bicycle utilization, reduce waiting times, and improve the overall experience for students, bridging the gap between those who own bicycles and those who need to rent them.
                                </p>

                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Project Scope</h3>
                                <ul class="list-disc list-inside text-gray-600 mb-4">
                                    <li>User registration and profile management.</li>
                                    <li>A comprehensive bicycle catalog for browsing available cycles.</li>
                                    <li>A streamlined reservation process based on available hours.</li>
                                    <li>Efficient cycle availability scheduling.</li>
                                    <li>Administrator and user management functionalities.</li>
                                </ul>
                                <p class="text-gray-600 mb-4">
                                    **Future Enhancements:** Features such as detailed bike maintenance scheduling and real-time bicycle location tracking are planned for future development but are not part of the current project scope.
                                </p>

                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Target Group</h3>
                                <p class="text-gray-600 mb-4">
                                    Currently, this system is exclusively targeting the residents of a specific student dormitory. Our users fall into two main categories:
                                </p>
                                <ul class="list-disc list-inside text-gray-600 mb-4">
                                    <li>Students who own bicycles and wish to rent them out for specific periods.</li>
                                    <li>Students who need to rent bicycles for their transportation needs.</li>
                                </ul>

                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Associated Risks</h3>
                                <p class="text-gray-600 mb-4">
                                    While we strive for a robust system, potential risks include:
                                </p>
                                <ul class="list-disc list-inside text-gray-600 mb-4">
                                    <li>System downtime or technical glitches.</li>
                                    <li>Potential data breaches.</li>
                                    <li>User dissatisfaction due to various factors.</li>
                                </ul>
                                <p class="text-red-600 font-semibold">
                                    **Important Note on Liability:** This platform's primary responsibility is to facilitate connections between bicycle owners and renters to minimize the gap in access. The platform itself is **not responsible for incidents such as bicycle damage or theft that may occur during the rental period.** Users engage in rentals at their own risk and are encouraged to establish their own agreements regarding liability for such incidents.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-2xl font-semibold text-gray-700">Terms and Conditions</h2>
                                <p class="text-gray-600 mb-4">
                                    Welcome to the Cycle Reservation System. By using this platform, you agree to abide by the following terms and conditions. Please read them carefully.
                                </p>

                                <ol class="list-decimal list-inside text-gray-600 mb-4">
                                    <li class="mb-3">
                                        <span class="font-semibold">Purpose of the Platform:</span> This platform serves as a digital intermediary to connect students within the designated student dormitory for the purpose of bicycle sharing and reservation based on available hours. It facilitates the reservation process between bicycle owners ("Lenders") and bicycle renters ("Renters").
                                    </li>
                                    <li class="mb-3">
                                        <span class="font-semibold">User Eligibility:</span> Membership and use of this platform are restricted to registered students residing in the specified student dormitory.
                                    </li>
                                    <li class="mb-3">
                                        <span class="font-semibold">User Responsibilities:</span>
                                        <ul class="list-disc list-inside ml-6 mt-2">
                                            <li><span class="font-semibold">For Lenders:</span> You are responsible for accurately listing your bicycle's availability, ensuring it is in good working condition, and making it available for pickup at the agreed-upon time.</li>
                                            <li><span class="font-semibold">For Renters:</span> You are responsible for returning the bicycle in the same condition as received, at the agreed-upon time and location. You must use the bicycle responsibly and in accordance with local traffic laws.</li>
                                        </ul>
                                    </li>
                                    <li class="mb-3">
                                        <span class="font-semibold">Reservation Process:</span> All bicycle reservations must be made exclusively through the platform. Reservations are subject to the availability posted by the Lender.
                                    </li>
                                    <li class="mb-3">
                                        <span class="font-semibold">Platform's Role and Liability Disclaimer:</span>
                                        <p class="mt-1">The Cycle Reservation System acts solely as a facilitator for connections between Lenders and Renters. **The platform explicitly disclaims any responsibility or liability for:**</p>
                                        <ul class="list-disc list-inside ml-6 mt-2">
                                            <li>Any damage to bicycles during the rental period.</li>
                                            <li>The theft of bicycles during the rental period.</li>
                                            <li>Any personal injury or property damage incurred by either Lender, Renter, or third parties during the use of a reserved bicycle.</li>
                                            <li>The condition or safety of any bicycle listed on the platform.</li>
                                        </ul>
                                        <p class="mt-1">Users acknowledge and agree that they engage in bicycle rental activities at their own risk. Lenders and Renters are strongly encouraged to communicate directly and establish their own agreements regarding liability, insurance, and dispute resolution for incidents that occur during the rental period.</p>
                                    </li>
                                    <li class="mb-3">
                                        <span class="font-semibold">System Availability:</span> While we strive to maintain continuous service, the platform may experience downtime due to maintenance, technical issues, or unforeseen circumstances. We are not liable for any losses or inconveniences caused by such unavailability.
                                    </li>
                                    <li class="mb-3">
                                        <span class="font-semibold">Data Privacy:</span> We are committed to protecting your privacy. Personal data collected will be used solely for the purpose of operating and improving the reservation system. For more details, please refer to our Privacy Policy (if applicable, you would link to a separate policy).
                                    </li>
                                    <li class="mb-3">
                                        <span class="font-semibold">Modifications to Terms:</span> These terms and conditions may be updated periodically. Continued use of the platform after any changes constitutes your acceptance of the revised terms.
                                    </li>
                                    <li class="mb-3">
                                        <span class="font-semibold">Governing Law:</span> These terms and conditions shall be governed by and construed in accordance with the laws of Germany. Any disputes arising under or in connection with these terms shall be subject to the exclusive jurisdiction of the courts located in Germany.
                                    </li>
                                </ol>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets/css/plugins/pickers/daterange/daterange.min.css')}}">
@endsection

@section('js')
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/pickadate/legacy.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.time.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection
