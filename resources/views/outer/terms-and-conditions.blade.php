@extends('outer.layouts.master')

@section('title')
    Terms and Conditions
@endsection
@section('content')

    <section class="py-10 py-md-14 overlay bg-black  overlay-60 bg-cover"
             style="background-image: url(assets/img/pattern.png);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center" data-aos="fade-up">

                    <!-- Heading -->
                    <h1 class="display-2 fw-bold text-white">
                        Terms & Conditions
                    </h1>

                    <!-- Text -->
                    <p class="lead text-white-75 mb-0">
                        {{ config('app.company_name') }}

                    </p>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <section class="pt-8 pt-md-11 pb-8 bg-light">
        <div class="container">

            <div class="row">

                <div class="col-12 col-md-8 w-100">

                    <!-- Text -->
                    <p class="text-gray-800 mb-6 mb-md-8">
                        Welcome to XMG Financial Services Ltd T/A XMG Remit (hereinafter referred to as "XMG Remit").
                        These terms and conditions (the "Terms") govern your access and use of the XMG Remit website
                        (the "Website"). By using the Website, you agree to be bound by these Terms. If you do not agree
                        to these Terms, please do not use the Website.
                    </p>

                    <!-- Heading -->
                    <h3 class="fw-bold">
                        1. ABOUT US
                    </h3>

                    <!-- Text -->
                    <p class="text-gray-800">
                        1.1 The XMG Remit digital services is offered in United Kingdom by XMG Financial
                        Services Ltd (“the Company”). the company’s registered office address: Unit 3, 29-31 Greatorex
                        Street, London, United Kingdom, E1 5NP; Company house Registration Number: 10966723.

                        <br>
                        1.2 The company is registered and regulated by the Financial Conduct Authority (FCA) as Small
                        Payment Institute (SPI); firm reference number 790926.
                        <br>
                        1.3 The company providing payment transmission service using the website and there is a link to
                        use the app on the mobile can be download on Apple store and can be get on Google play.
                        <br>
                        the company currently operating the website under hosted domain
                        https://xmgfinancialservices.com/ directly and another domain www.xmgremit.com redirect.
                    </p>


                    <h3 class="fw-bold">
                        2. PRIVACY POLICY
                    </h3>

                    <!-- Text -->
                    <p class="text-gray-800 mb-5">
                        2.1 Your use of website is subject to the XMG Remit Privacy Policy. Please review
                        the Privacy Policy before using the Website.
                    </p>
                    <!-- List -->


                    <!-- Heading -->
                    <h3 class="fw-bold">
                        3. USE OF THE WEBSITE
                    </h3>
                    <p class="text-gray-800">
                        3.1 You may use the Website for the sole purpose of obtaining information about XMG Remit and
                        its services.<br>
                        3.2 You may not use the Website for any illegal or unauthorized purpose, including but not
                        limited to transmitting any content that is unlawful, fraudulent, defamatory, or obscene.<br>
                        3.3 You may not use any software, device, or process to interfere with or attempt to interfere
                        with the proper working of the Website.<br>
                        3.4 You may not use any robot, spider, or other automatic device or process to monitor or copy
                        any content on the Website.<br>
                        3.5 You agree to provide accurate and complete information when using the Website.
                    </p>


                    <!-- Heading -->
                    <h3 class="fw-bold">
                        4. ACCOUNT REGISTRATION
                    </h3>
                    <p class="text-gray-800 mb-5">


                        4.1 Users must be at least 18 years old<br>
                        4.2 Have their habitual residence in the United Kingdom in order to use the service.<br>
                        4.3 Each money transfer made through XMG Remit Online Service is assigned a unique transaction
                        number, known as the Money Transfer Control Number (MTCN)
                    </p>


                    <h3 class="fw-bold">
                        5. ELIGIBILITY
                    </h3>
                    <p class="text-gray-800 mb-5">
                        5.1 In order to use the services provided by XMG Remit, you must be at least 18 years old<br>
                        5.2 Have the legal capacity to enter into a contract.<br>
                        5.3 By creating an account on XMG Remit, you certify that you meet these requirements.<br>
                        5.4 To use our services, you must register an account on our website.<br>
                        5.5 During the registration process, you will be required to provide certain personal
                        information, including your name, date of birth, address, email address, and phone number.<br>
                        5.6 You are responsible for ensuring that all the information you provide is accurate and
                        up-to-date.
                    </p>


                    <h3 class="fw-bold">
                        6. ACCOUNT SECURITY
                    </h3>
                    <p class="text-gray-800 mb-5">
                        6.1 You are responsible for maintaining the confidentiality of your account login details,
                        including your username and password.
                        <br>
                        6.2 You agree to notify XMG Remit immediately if you become aware of any unauthorised access to
                        your account or any other breach of security.
                    </p>


                    <h3 class="fw-bold">
                        7. AVAILABILITY OF SERVICES
                    </h3>
                    <p class="text-gray-800 mb-5">
                        7.1 XMG Remit will make reasonable efforts to ensure that our services are available at
                        all times unless otherwise we mention on the website, but we do not guarantee uninterrupted
                        access to our website or services. We are not responsible for any loss or damage that may result
                        from the unavailability of our website or services.
                    </p>


                    <h3 class="fw-bold">
                        8. TERMINATION
                    </h3>
                    <p class="text-gray-800 mb-5">
                        8.1 XMG Remit reserves the right to terminate your account at any time, for any reason, with or
                        without notice.<br>
                        8.2 If your account is terminated, any transactions that have not yet been completed will be
                        cancelled.
                    </p>


                    <h3 class="fw-bold">
                        9. INTELLECTUAL PROPERTY
                    </h3>
                    <p class="text-gray-800 mb-5">
                        9.1 The Website and its content are the property of XMG Remit and are protected by copyright,
                        trademark, and other intellectual property laws.<br>
                        9.2 You may not reproduce, distribute, modify, or create derivative works of any content on the
                        Website without the prior written consent of XMG Remit.
                    </p>

                    <h3 class="fw-bold">
                        10. DISCLAIMER OF WARRANTIES
                    </h3>
                    <p class="text-gray-800 mb-5">
                        10.1 The website of XMG Remit, a money remittance provider based in the UK, is provided on an
                        "as is" and "as available" basis without warranty of any kind, either express or implied. XMG
                        Remit makes no representations or warranties of any kind, whether express, implied, statutory or
                        otherwise regarding the website or the services provided through it.<br>
                        10.2 XMG Remit does not warrant that the website will be error-free or uninterrupted, that
                        defects will be corrected, or that the website or the servers that make it available are free of
                        viruses or other harmful components. XMG Remit does not warrant or make any representations
                        regarding the use or the results of the use of the website or the services provided through it
                        in terms of their correctness, accuracy, reliability, or otherwise.<br>
                        10.3 By using the website, you acknowledge and agree that the use of the website and the
                        services provided through it is at your sole risk. XMG Remit shall not be liable for any
                        XMG Remit will make reasonable efforts to ensure that our services are available at
                        damages whatsoever arising out of or in connection with the use of the website or the services
                        provided through it, including but not limited to direct, indirect, incidental, consequential,
                        punitive, or any other damages.<br>
                        10.4 XMG Remit reserves the right to modify, suspend, or discontinue any aspect of the website
                        or the services provided through it at any time, including the availability of any feature,
                        database, or content, without prior notice or liability.
                    </p>


                    <h3 class="fw-bold">
                        11. LIMITATION OF LIABILITY
                    </h3>
                    <p class="text-gray-800 mb-5">
                        11.1 XMG Remit will make every effort to ensure the accuracy and reliability of the information
                        presented on its website. However, XMG Remit does not guarantee the accuracy, completeness,
                        reliability or suitability of any information or data found on its website.<br>
                        11.2 Furthermore, XMG Remit shall not be liable for any damages, losses, or expenses arising out
                        of the use or inability to use its website, including but not limited to, indirect or
                        consequential damages, loss of profits, or any damages arising from loss of data or business
                        interruption.<br>
                        11.3 By utilizing the website of XMG Remit, you acknowledge and consent to indemnifying, defending, and protecting XMG Remit, along with its directors, officers, employees, agents, and affiliates, against any claims, damages, or losses that may arise from your usage of the website or any violation of these terms of use.<br>
                        11.4 In no event shall XMG Remit's liability to you exceed the amount paid by you to XMG Remit
                        for the services provided through its website.<br>
                        11.5 This Limitation of Liability shall apply regardless of the form of action, whether in
                        contract, tort, strict liability, or otherwise, and whether or not XMG Remit has been advised of
                        the possibility of such damages.<br>
                        11.6 If you do not agree with this Limitation of Liability, you must not use XMG Remit's website
                        or services.
                    </p>


                    <h3 class="fw-bold">
                        12. GENERAL
                    </h3>
                    <p class="text-gray-800 mb-5">
                        12.1 XMG Remit reserves the right to modify these Terms at any time without prior notice.<br>
                        12.2 These Terms shall be governed by and construed in accordance with the laws of England and
                        Wales.<br>
                        12.3 Any disputes arising out of or in connection with these Terms shall be subject to the
                        exclusive jurisdiction of the courts of England and Wales.<br>
                        12.4 If any provision of these Terms is found to be invalid or unenforceable, the remaining
                        provisions shall remain in full force and effect.<br>
                        12.5 These Terms constitute the entire agreement between you and XMG Remit with respect to the
                        use of the Website.<br>
                        12.6 Fees and Exchange Rates XMG Remit charges a fee for each transaction, which will be
                        displayed on the website at the time of the transaction. XMG Remit also applies an exchange rate
                        to each transaction, which may be different from the prevailing market rate. By using the
                        Service, you agree to pay these fees and accept the exchange rate offered by XMG Remit.<br>
                        12.7 Cancellation and Refunds If you wish to cancel a transaction, you must do so before the
                        funds have been paid out to the recipient. If you cancel a transaction before it is processed,
                        you will receive a refund of the transaction amount, minus any fees charged by XMG Remit. If a
                        transaction is cancelled or rejected by XMG Remit, you will receive a full refund of the
                        transaction amount.<br>
                        12.8 Anti-Money Laundering and Fraud Prevention XMG Remit is committed to preventing money
                        laundering and other illegal activities. To comply with anti-money laundering laws and
                        regulations, XMG Remit may ask you to provide additional information or documentation to verify
                        your identity or the purpose of a transaction. XMG Remit reserves the right to refuse any
                        transaction or account that it believes may be connected to illegal activities.
                    </p>

                    <h3 class="fw-bold">
                        13. GOVERNING LAW AND JURISDICTION
                    </h3>
                    <p class="text-gray-800 mb-5">
                        13.1 This website is governed by and construed in accordance with the laws of England and Wales.<br>
                        13.2 Any dispute arising out of or in connection with this website, including any question
                        regarding its existence, validity, or termination, shall be referred to and finally resolved by
                        the courts of England and Wales.<br>
                        13.3 XMG Remit and the user hereby submit to the exclusive jurisdiction of the courts of England
                        and Wales for the purposes of any such dispute or proceedings.<br>
                        13.4 XMG Remit makes no representation that the content of this website complies with the laws
                        of any country outside the UK. If you access this website from outside the UK, you do so at your
                        own risk and are responsible for compliance with the laws of your jurisdiction.<br>
                        13.5 XMG Remit reserves the right to amend or modify this governing law and jurisdiction clause
                        at any time without prior notice to you. By continuing to use this website, you agree to be
                        bound by the terms and conditions as modified from time to time.<br>
                        This terms and condition initial version April 2023
                    </p>
                    <h3 class="fw-bold">
                        14. DISPUTE RESOLUTION PROCESS
                    </h3>
                    <p class="text-gray-800 mb-5">
                        14.1 Contact Customer Support: In case of a dispute or concern regarding our services, we
                        encourage you to reach out to our dedicated customer support team. They are available to assist
                        you and address any issues you may have. You can contact our customer support through various
                        channels, including phone, email, or online chat.<br>
                        14.2 Provide Detailed Information: When contacting our customer support team, please provide
                        them with all relevant details related to the dispute. This may include transaction details,
                        dates, amounts, and any supporting documentation or evidence you have regarding the issue. Clear
                        and comprehensive information will help us understand and resolve the dispute more
                        effectively.<br>
                        14.3 Investigation and Resolution: Once we receive your dispute, our team will initiate an
                        investigation into the matter. We will carefully review all provided information and assess the
                        situation in accordance with UK laws and regulations governing our services. Our goal is to
                        reach a fair and reasonable resolution promptly.<br>
                        14.4 Communication and Updates: Throughout the dispute resolution process, we will maintain open
                        lines of communication with you. We will provide regular updates on the progress of the
                        investigation and any actions being taken to address the dispute. You can expect timely and
                        transparent communication from our team.<br>
                        14.5 Resolution and Outcome: We will determine an appropriate resolution for the dispute based
                        on the investigation findings. This may involve corrective actions, refunds, or other measures
                        to address the issue and ensure your satisfaction. We will inform you of the outcome and any
                        steps taken to resolve the dispute.<br>
                        14.6 Escalation to Regulatory Authorities: If, despite our best efforts, a satisfactory
                        resolution cannot be reached, and the dispute falls within the jurisdiction of regulatory
                        authorities, we will provide guidance on how you can escalate the matter to the relevant
                        regulatory bodies in the UK. We are committed to cooperating with regulatory authorities and
                        complying with their requirements.<br>
                        At XMG Remit, we take disputes seriously and are dedicated to resolving them in a fair and
                        transparent manner. We aim to provide a positive customer experience, and we strive to promptly
                        and efficiently address any concerns or disputes promptly and efficiently within the framework
                        of UK law.
                    </p>
                    <h3 class="fw-bold">
                        15. ONLINE TRANSACTION PROCESS
                    </h3>
                    <p class="text-gray-800 mb-5">
                        15.1 All online transactions are conducted according to the following process: <br>

                    <ol type="i">
                        <li>The Cardholder/Sender, the individual who owns the debit or credit card, initiates and
                            completes the transaction.
                        </li>
                        <li>The Cardholder/Sender selects the debit/credit card payment option.</li>
                        <li>The card information is securely transferred to the payment gateway.</li>
                        <li>The payment gateway forwards the card information to the payment processor.</li>
                        <li>The payment processor then transfers the transaction details through the card networks to
                            the issuing bank.
                        </li>
                        <li>The issuing bank verifies the Cardholder/Sender's credit card/debit card information.</li>
                        <li>Upon successful verification, the card network requests authorization from the issuing bank
                            to release funds, ensuring sufficient account balance and conducting anti-fraud checks.
                        </li>
                        <li>The issuing bank provides a response to the credit/debit card network, indicating whether
                            the transaction is approved or declined.
                        </li>
                    </ol>
                    15.2 Once the transaction is completed, a unique transaction number is generated for reference.<br>
                    15.3 The company maintains comprehensive records of each transaction for audit and reconciliation
                    purposes.<br>
                    </p>
                    <h3 class="fw-bold">
                        16. COMPLAINTS-HANDLING PROCESS
                    </h3>
                    <p class="text-gray-800 mb-5">
                        16.1 All customers engaging in online transactions are advised to contact the business directly
                        if they encounter any issues or concerns related to the transaction process. <br>
                        16.2	The business will handle all complaints in accordance with the established complaints-handling process. <br>
                        16.3	The complaints-handling process is detailed in the Complaints Handling Policy, which customers can refer to for further guidance. <br>
                        16.4	The business is committed to resolving complaints promptly, fairly, and transparently. <br>
                    </p>
                </div>

            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>
@endsection
