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
                    <h2 class="">Introduction</h2>
                    <p class="text-3 ">
                        You agree to be bound by these terms and conditions if you use our services. You consent to
                        the implementation of the money transfer and acceptance of the terms and conditions by
                        initiating a send or receive transaction either through an agent location or through our
                        mobile app or online through our web portal. The terms and conditions are legally binding,
                        and you must read all the terms in their entirety. There are also provisions covering
                        termination of our commitments, limited liability, and exemptions from our liability for
                        damages.
                    </p>
                    <h2 class="">About Us</h2>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} is incorporated in England under <b>Companies House No.
                            SC769545</b> with its
                        registered
                        address at {{ config('app.company_address') }}. {{ config('app.company_name') }}
                        is authorized by the FCA for the provision of payment services under FCA FRN <b> No.
                            998336. </b>


                    </p>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} offers money transfer services internationally. The service is
                        provided by
                        {{ config('app.company_name') }} through its partners via a network of agents or through our
                        mobile app/online web
                        portal.
                    </p>
                    <h2 class="">Contract</h2>
                    <p class="text-3 ">
                        Every money transfer constitutes a separate agreement between {{ config('app.company_name') }}
                        and the sender of
                        the funds.
                    </p>
                    <p class=" text-3">
                        When sending money through {{ config('app.company_name') }} , you agree to us using our partners
                        to process your
                        transaction and share relevant details with our partners. The terms and conditions along
                        with other documentation related to the Service constitute the entire agreement/ contract
                        between {{ config('app.company_name') }} /its partners and you, which governs the use of the
                        service and the
                        individual recipient of the service.
                    </p>
                    <p class="text-3 ">
                        Terms and conditions are subject to changes depending on changes in the law or regulatory
                        requirements. Any changes made after the completion of a transaction will not apply to the
                        current transaction. These changes will only apply to transactions processed after the date
                        the changes have been made.
                    </p>
                    <p class="text-3 ">
                        If you would like a copy of the terms and conditions or additional information about our
                        services, please contact us at <a href="mailto:info@oriumglobalresources.com">info@oriumglobalresources.com</a>

                    </p>
                    <h2 class="">Our Services</h2>
                    <p class="text-3 ">
                        The service allows you to send money to a recipient designated by you. The money can be
                        collected by a recipient in cash or sent to the recipient’s bank account or the customer can
                        send money directly via Mobile App/ Web portal.
                    </p>
                    <p class="text-3 ">
                        To use the {{ config('app.company_name') }} service, you must be at least 18 years of age. The
                        service is for
                        personal use only and may not be used for gambling purposes, escrow, or trust purposes.
                        Please read the fraud warning on the form. We will not be liable if you change your mind
                        after a recipient designated by you has been paid.
                    </p>
                    <p class="text-3 ">
                        When the money transfer is conducted, certain information will be requested including
                        identification details which is a requirement to meet our regulatory responsibilities.
                        Certain partners will require the selection of a pay-out agent in the receiving country. To
                        change a payout location, you may need to contact our partner directly or we may need to
                        refer your query to our partners.
                    </p>
                    <p class="text-3 ">
                        A control number/PIN is provided to you on the completion of a transaction which must only
                        be provided to the recipient of the transaction to enable the collection of the funds.
                        {{ config('app.company_name') }} provides various options for funds being received. The
                        transaction can either be
                        sent directly to a bank account or paid out in cash. For pay-outs in cash, on the receiving
                        side, the recipient will also be requested to provide identification details to ensure that
                        the correct recipient is being paid out.
                    </p>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} will endeavour to make the transaction available for payment to
                        the recipient
                        either in a few minutes, by the end of the next working day, or latest by the seventh
                        business day depending on which partner the funds are sent through, subject to statutory or
                        regulatory requirements. If a transaction has been processed at an agent location, a delay
                        can occur if the agent location is unable to provide the funds for payment promptly.
                    </p>
                    <p class="text-3 ">
                        The sender is responsible for providing the recipient with the details of the transactions
                        to enable the collection of funds.
                    </p>
                    <p class="text-3 ">
                        Any errors in the details provided for the recipient could result in a delay in the
                        transaction being paid.<br>
                        The fee for the transaction will be indicated on the receipt provided at the agent location
                        or on the mobile app/ online web portal

                    </p>
                    <p class="text-3 ">
                        Payment shall be made when the relevant details required by {{ config('app.company_name') }} or
                        its partners are
                        provided by the recipient including the name of the sender, transaction number, sum sent and
                        country from where the money was sent along with a valid government-issued ID, there may be
                        some local restrictions and additional local regulatory requirements. The acceptable forms
                        of identification differ depending on the country in which the transfer is collected.
                        Payment shall be made to the person that {{ config('app.company_name') }} or its agent deems
                        entitled to receive
                        the transaction pay-out.
                    </p>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} will have fulfilled its requirement to you to pay out the
                        transaction to the
                        recipients providing the above-mentioned details. For pay-outs at agent locations, the
                        pay-out will be made during the agent opening hours and if the agent has the funds available
                        to conduct the pay-out.
                    </p>
                    <p class="text-3 ">
                        Applicable laws prohibit money transmission companies from conducting business with certain
                        individuals. {{ config('app.company_name') }} and its partners are required to screen all
                        transactions against the
                        list of asset freeze targets issued by the office of financial sanctions implementation, HM
                        treasury. If there is a match, {{ config('app.company_name') }} will investigate to determine if
                        the match is a
                        real match to the name in the list, during the investigation, there may be a delay in the
                        transaction being paid out. Additional details may be requested during the investigation,
                        including additional identification details from the sender and/or recipient of the money
                        transfer.
                    </p>
                    <p class="text-3 ">
                        In addition to our services, the agent may also offer their products and services. These
                        additional products and services are separate and independent of our service and are offered
                        under the agent's terms and conditions.
                    </p>
                    <p class="text-3 ">
                        <b> Fraud warning: </b> send funds only to individuals you know or can verify as
                        trustworthy. the
                        service must only be used to send funds to family or friends and not for business purposes.
                        If you suspect you are a victim of fraud, contact {{ config('app.company_name') }} immediately
                        at +44 772 574 6316
                    </p>
                    <h2 class="">Access to Mobile App and Online Web Portal</h2>
                    <p class="text-3 ">
                        By using our mobile app and online web portal, you represent and warrant that you are 18
                        years or older. We have the right to cancel access if it comes to our attention that you are
                        under the age of 18.<br>
                        On completing the registration requirements on the mobile app or online web portal, you will
                        be provided with login details that are not transferable. You are responsible for ensuring
                        that the mobile app and online web portal are only accessed by you and that login details
                        are kept safe and secure. Any damages as a result of the use of the login details by a third
                        party will be your responsibility.

                    </p>
                    <p class="text-3 ">
                        For any suspicions concerning the confidentially of the app and access to the online web
                        portal, you must notify {{ config('app.company_name') }} immediately. Any undue delay in
                        contacting {{ config('app.company_name') }} may
                        result in you becoming liable for any losses.
                    </p>
                    <p class="text-3 ">
                        Login details must be updated regularly, every month as a minimum. Ensure that you log out
                        of the app and online web portal after conducting the transaction. We reserve the right to
                        disable access to the app or online web portal at any time for any reason including failure
                        to abide by the terms and conditions.
                    </p>
                    <p class="text-3 ">
                        For payments through the mobile app and the online web portal, you must ensure that you have
                        funds in the account from which payment is being made. We accept payment by debit card but
                        you must authorize your card issuer to transfer the funds required to be received by us for
                        the transaction. <b> Please note that we do not provide service for credit card users. </b>
                    <p class="text-3 ">
                        Terms and conditions of the card issuer will apply to the use of your card or bank account
                        and you must refer to such agreements when making funds required for the transaction. For
                        conducting online transactions, you will need to obtain equipment including a computer or
                        device, telecommunications lines, an operating system, printer to print out any records on
                        paper. You acknowledge that certain software and equipment that you use may not be able to
                        support certain features of our services. We have the right to discontinue supporting an
                        operating system if we determine that the operating system is open to security risks.
                    </p>
                    <h2 class="">Consent for Electronic Notices/ Communication</h2>
                    <p class="text-3 ">
                        We may need to reach out to you to provide additional information about your transaction,
                        request additional information about your transaction or respond electronically to an issue.
                        You consent to receive communication and notices from {{ config('app.company_name') }} to pay
                        electronically (to
                        the extent permitted by law). You have the right to withdraw the claim to receive notices on
                        communication.
                    </p>
                    <h2 class="">Updated Information</h2>
                    <p class="text-3 ">
                        You consent to provide {{ config('app.company_name') }} with updated information concerning your
                        transaction
                        including your email address and residential address.
                    </p>
                    <h2 class="">Our Responsibility to You</h2>
                    <p class="text-3 ">
                        We will take due care in processing your transaction, abiding by the terms and conditions
                        stated in this document. We do not, however, take responsibility for transactions being
                        declined, terminated, or restricted.
                    </p>
                    <h2 class="">We do not accept liability for</h2>
                    <ul class="text-3">
                        <li>Card issuer services</li>
                        <li>For damages as a result of a transaction being delayed or cancelled</li>
                        <li>If the transaction is processed through the mobile app/online web portal and you do
                            not have an internet connection it results in a delay or the transaction not being
                            completed.
                        </li>
                        <li>Incorrect or incomplete information provided to the agent or on the mobile app/online
                            web portal which results in the transaction being delayed or cancelled
                        </li>
                        <li>Unauthorized use of the information unless this is the result of our negligence.</li>
                        <li>If the mobile app/ online web portal stops working or is disrupted.</li>
                        <li>If the money transfer is delayed for matters outside of our control although we will
                            aim to limit the time it takes to resolve the issue.
                        </li>
                        <li>Delays in the transaction being paid out or the service being unavailable as a result
                            of agent location hours, availability of currency, money being sent to a different time
                            zone, and identification requirements. Additional restrictions may also apply.
                        </li>
                        <li>The supply of properties or goods and services which were paid for using the service.
                        </li>
                    </ul>
                    <h2 class="">The Transaction May Be Suspended or/and Terms and Conditions May Be terminated
                        if</h2>
                    <ul class="text-3">
                        <li>The details provided are not accurate or incomplete.</li>
                        <li>You are in breach of the terms and conditions including the requirement to pay our
                            fee.
                        </li>
                        <li>We are not able to verify your identity.</li>
                        <li>If we suspect that the {{ config('app.company_name') }} regulatory requirements will be
                            breached including
                            regulations for preventing money laundering, terrorist financing, and fraud.
                        </li>
                        <li>Due to the requirements of a government or regulatory body.</li>
                        <li>A court order is issued which we need to comply with.</li>
                        <li>The transaction is being processed on behalf of a third party or we suspect the
                            transaction may have been forged.
                        </li>
                        <li>Additional information requested is not provided.</li>
                        <li>The card issuer does not authorize the payment.</li>
                        <li>You pass away, become insolvent, a bankruptcy petition is presented against you, you
                            enter into a voluntary arrangement, or go into liquidation.
                        </li>
                        <li>The sender attempts to transfer or charge funds from a debit card that does not belong
                            to the sender.
                        </li>
                        <li>We determine that the profile has been inactive for a substantial time.</li>

                    </ul>
                    <h2 class="">Refusal of a Transaction</h2>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} and its agents may refuse a transaction without providing a
                        reason, in
                        particular, to prevent fraud, money laundering, or terrorist financing, a requirement by
                        law, due to a request by a regulatory body, law enforcement body, due to a court order or
                        based on our internal policy.
                    </p>
                    <h2 class="">Unauthorized Transaction</h2>
                    <p class="text-3 ">
                        Under the regulations, we may be liable if we perform a transaction that you did not
                        authorize us to process. If you suspect such a transaction has occurred, you must inform us
                        in writing as soon as you realize that such an unauthorized payment has occurred. We will
                        then investigate the matter.
                    </p>
                    <p class="text-3 ">
                        We must be informed in writing within 13 months of the incident occurring if the refund is
                        to be considered. If during our investigation we determine that the transactions have been
                        authorized by you, the refund will not be done. For any fraud identified, you will remain
                        liable to us.
                    </p>
                    <p class="text-3 ">
                        We will have no liability if we are unable to perform the transaction correctly where it is
                        a statutory obligation or the reason was for events outside of our control.
                    </p>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} shall be liable for damages resulting from the intentional
                        gross misconduct by
                        staff or agents while processing the transaction subject to applicable law. Liability is
                        excluded in cases of minor negligence.
                    </p>
                    <p class="text-3 ">
                        The liability of {{ config('app.company_name') }} is limited to refund for foreseeable damage to
                        the contract is
                        limited to EUR 500 (in addition to the amount transferred and charges).
                    </p>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} will not be liable where details of the transaction have been
                        wilfully or
                        negligently shared with a third party.
                    </p>
                    <p class="text-3 ">
                        Where it is unlawful for us to do so, we do not limit our liability to you.
                    </p>
                    <h2 class="">Your Responsibility to Us</h2>
                    <ul class="text-3">
                        <li>To abide by the terms and conditions.</li>
                        <li>To provide information for the money transfer that is accurate and complete.</li>
                        <li>Do not use the service for any illegal purpose.
                        </li>
                        <li>For transactions processed through the mobile app and online web portal, ensure the
                            payment is cleared by the card issuer.
                        </li>
                        <li>To keep the login details provided for the mobile app and online web portal safe and
                            secure, do not share these details with anyone else.
                        </li>
                        <li>Ensure that the details of the transfer are only passed to the recipient and no one
                            else.
                        </li>
                        <li>You consent to {{ config('app.company_name') }} conducting checks to verify your identity.
                        </li>
                        <li>You consent to provide any additional documentation requested
                            by {{ config('app.company_name') }} to verify
                            the identity, source of funds, and source of wealth of transactions.
                        </li>
                        <li>You consent to {{ config('app.company_name') }} forwarding to regulatory bodies or law
                            enforcement bodies
                            your details if we suspect the transaction may be linked to money laundering, terrorist
                            financing, and for the prevention of fraud.
                        </li>
                    </ul>
                    <h2 class="">Privacy Policy</h2>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} does not share consumer information with third parties unless
                        there is a legal or
                        regulatory requirement to do so. The law does permit the sharing of personal information
                        where it is necessary to administer a transaction that is authorized by a consumer.
                    </p>
                    <p class="text-3 ">
                        The law also permits the sharing of personal data when it is required to protect the
                        security or confidentiality of the records and to resolve consumer disputes, fraud, claims,
                        unauthorized transactions, local laws, legal requirements, and regulations. These are
                        examples of cases where data is permitted to be shared by law but there may be other
                        scenarios.
                    </p>
                    <p class="text-3 ">
                        By processing the transaction with {{ config('app.company_name') }} , you authorize us to
                        conduct additional checks
                        to meet our regulatory requirements including background checks. Additional documentation
                        may also be requested including the source of funds and source of wealth.
                    </p>
                    <p class="text-3 ">
                        The data collected by {{ config('app.company_name') }} is used for
                    </p>
                    <ul class="text-3">
                        <li>Admin purposes</li>
                        <li>Customer services</li>
                        <li>Mitigating risks including the risk of fraud, money laundering, and terrorist
                            financing.
                        </li>
                    </ul>
                    <p class="text-3 ">
                        Personal data is transferred to our partners and also outside of the EU.
                    </p>
                    <p class="text-3 ">
                        Personal information will be retained by {{ config('app.company_name') }} and its partners for
                        the period required
                        by {{ config('app.company_name') }} to meet its legal and regulatory requirements. The
                        information requested may
                        change dependent on the current regulatory requirements. We may also request and share data
                        with regulatory bodies and law enforcement.
                    </p>
                    <p class="text-3 ">
                        You have the right to request details on the personal data we hold along with a breakdown of
                        your transactions free of charge. You also have the right to request deletion or correction
                        of data, and restriction of personal data usage including the right to request a restriction
                        on the portability of the data. A request will need to be made in writing and an ID must be
                        provided when making the request. Request to delete data or restrict data movement will be
                        reviewed by the data protection officer, the personal data requested is a regulatory
                        requirement, and deletion of data for transactions already processed may not be possible.
                        Once the request is made, the processing time is two weeks. Further details can be obtained
                        by contacting
                        If you have concerns concerning how your data is handled or any other concerns concerning
                        this notice, please contact our data privacy officer
                        You can also raise a complaint with the Information Commissioner’s Office if we fail to
                        resolve your data protection concerns.

                    </p>
                    <h2 class="">Fees</h2>
                    <p class="text-3 ">
                        As per the regulations, the fees and exchange rate will be provided before the execution of
                        the transaction, the execution of the transaction is an acceptance of the charges and
                        exchange rate of the transaction. You will be required to pay {{ config('app.company_name') }}
                        charges for using
                        the service as well as details of the exchange rate.
                    </p>
                    <p class="text-3 ">
                        Payments on the receiving side will be made in the currency of the receiving country. The
                        rate of exchange is calculated based on interbank rates with a margin. The currency rate
                        shown during the transaction will be the rate that will be applied during the payout of the
                        transaction. For some countries, however, due to local laws, the rate may be an estimate and
                        the actual exchange rate is confirmed when the transaction is paid.
                    </p>
                    <p class="text-3 ">
                        For certain partners, for cash pickup transfers outside of the EEA where USD has been
                        selected as the pay-out currency, and the location may not payout in USD, the amount sent
                        will be converted into the local currency.
                    </p>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} is not obliged to match or exceed exchange rates offered
                        publicly by other
                        currency exchange providers. Rates of exchange are adjusted several times a day in line with
                        financial markets.<br>
                        When using the mobile app for a transaction, any fees charged by the phone service provider
                        such as charges for data services or any fees, you will be solely responsible for these
                        charges.

                    </p>
                    <p class="text-3 ">
                        In certain receiving countries, local taxes and services may be levied at the time of
                        collection. The receiver may incur additional charges if receiving funds in an account.
                        Responsibility for checking whether the receiving bank will add additional charges lies with
                        the sender of the transaction.
                    </p>
                    <p class="text-3 ">
                        {{ config('app.company_name') }} may charge an administrative fee if the transaction is not
                        collected within one
                        year of the date of the transaction. If the transaction has not been collected within 90
                        days, the transaction will be considered as ‘expired’ and we will have no obligation to
                        execute an expired transfer. For expired transfers, we will attempt to contact the sender to
                        arrange a refund. If the sender becomes aware of the expiry of the transfer, the sender
                        should contact us to arrange for a refund.
                    </p>
                    <h2 class="">Right to cancel/ Request refund</h2>
                    <p class="text-3 ">
                        You do not have the right to cancel a transaction. We may however be able to cancel the
                        transaction if the recipient has not collected or received the funds. The cancellation
                        request must be in writing and will in most cases be processed promptly but can take up to
                        7 days to process.
                    </p>
                    <p class="text-3 ">
                        We do not charge any fees for cancelling and refunding a transaction. For cash transfers
                        where the transfer was not made properly or the funds did not arrive, we will refund both
                        the amount sent and the fee. For transfers to accounts, where the transfer was not made
                        properly or the funds did not arrive, we will refund both the amount sent and the fee.
                        Refund requests will not be accepted if the request was unduly delayed or 13 months have
                        passed since the transaction was processed.
                    </p>
                    <h2 class="">Intellectual Property Rights</h2>
                    <p class="text-3 ">
                        All trade names, trademarks, service marks, copyrights, and other property rights
                        of {{ config('app.company_name') }} are owned by {{ config('app.company_name') }} respectively.
                        They are protected by UK laws governing
                        trademarks, service marks, copyrights, and other property rights. You are permitted to use
                        the {{ config('app.company_name') }} service including the mobile app/online web portal for
                        personal,
                        non-commercial use only.<br>
                        You must not use, modify, republish or reproduce copies of any graphics, images, promotional
                        material, or text on our mobile app/online web portal or any receipts or documents shared
                        with you by {{ config('app.company_name') }} or its agents. The copy may only be used to review
                        the materials that
                        are being provided.

                    </p>
                    <h2 class="">Conflicts of Interest</h2>
                    <p class="text-3 ">
                        Money transfers do not tend to give rise to conflicts of interest. If a conflict does occur,
                        {{ config('app.company_name') }} will provide the consumer with the details of the conflict
                        including the nature
                        of the conflict, and will ensure that the conflict does not result in a loss to the
                        consumer.
                    </p>
                    <h2 class="">Jurisdiction of Law</h2>
                    <p class="text-3 ">
                        All matters arising from, or out of, or in connection with the agreement without any
                        limitation whatsoever shall be determined following English law and the parties hereby
                        submit to the non-exclusive jurisdiction of the courts of England and Wales to settle any
                        matter or dispute arising out of or in connection with it. A third party shall not have any
                        rights under the contracts (rights of the third-party act 1999) to enforce the contract.
                    </p>
                    <h2 class="">Complaints Procedure</h2>
                    <p class="text-3 ">
                        For any problems that you face concerning the service, please contact
                        the {{ config('app.company_name') }} head
                        office by emailing us at <a href="mailto:info@oriumglobalresources.com">info@oriumglobalresources.com</a>
                        calling
                        us at +44 772 574 6316,
                        or writing to us at the following address: {{ config('app.company_name') }} , {{ config('app.company_address') }}
                    </p>
                    <p class="text-3 ">
                        We will deal with your complaint promptly and fairly. We will respond to your complaint
                        within 15 days or send a holding response of 15 days while we investigate the matter. The
                        final response to your complaint will be made within 35 days of the complaint first being
                        raised. We may need to refer your complaint to a partner or you may need to approach a
                        partner directly to resolve the issue. Details of this will either be on your receipt or we
                        will inform you of this when you contact us.
                    </p>
                    <p class="text-3 ">
                        If you are not satisfied with the response to the complaint, you have the right to refer the
                        complaint to the financial ombudsman. Contact details for the financial ombudsman can be
                        found here: <a href="https://www.financial-ombudsman.org.uk/contact-us">https://www.financial-ombudsman.org.uk/contact-us.</a>
                    </p>
                </div>


            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>
@endsection
