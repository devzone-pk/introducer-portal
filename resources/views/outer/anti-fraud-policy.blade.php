@extends('outer.layouts.master')
@section('content')


    <!-- Page Header
        ============================================= -->
    <style>

        ol, ul {
            padding-left: 0;
            font-size: 16px;
        }
        ::marker{
            font-weight: bolder;
        }
    </style>

    <section class="pt-8 pt-md-11 pb-8 pb-md-14 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md">

                    <!-- Heading -->
                    <h1 class="display-4 mb-2">
                        Anti Fraud Policy
                    </h1>

                    <!-- Text -->
                    <p class="fs-lg text-gray-700 mb-md-0">
                        Following is our detailed Anti Fraud Policy
                    </p>

                </div>
                <div class="col-auto">

                    <!-- Buttons -->
                    <a href="#!" class="btn btn-primary-soft d-none">
                        Print
                    </a>

                </div>
            </div> <!-- / .row -->
            <div class="row">
                <div class="col-12">

                    <!-- Divider -->
                    <hr class="my-6 my-md-8">

                </div>
            </div> <!-- / .row -->
            <div class="row">
                <div class="col-12 col-md-8">
                    <h2 class="">Introduction</h2>
                    <p class=" text-justify">
                        {{ config('app.company_name')}} is committed to deterring fraudulent transactions through the education of
                        Agents/ Partners and staff to ensure that victims can be identified and assisted quickly.
                        The {{ config('app.company_name')}} Anti-Fraud policy/guide is designed to help detect, deter and prevent
                        consumer fraud.
                    </p>
                    <p class=" text-justify">
                        There are two main risks to the money transfer sector in relation to fraud, <b class="mt-3">Consumer
                            Victim</b>
                        fraud and <b class="mt-3">Agent/Partner Victim</b> fraud. This document will define both of these fraud
                        types,
                        identify common indictors and cover the types of consumer and Agent / Partner victim fraud.
                        Fraud is a growing issue in the payments sector. The 2017 UK fraud indicator estimates that
                        fraud losses in the UK to be around £190 billion a year. Fraud is the most commonly
                        experienced crime in the UK.
                    </p>
                    <p class=" text-justify">
                        These crimes can have devastating effects on victims. Victims may lose all their savings and
                        can be impacted psychologically. Criminals may use the funds stolen to fund illicit
                        activities that damage society such as people smuggling, terrorism, and drug trafficking.
                    </p>
                    <p class=" text-justify">

                        Criminals use a wide range of methods to commit fraud with the theft of personal and
                        financial data through social engineering and data breaches as the major contributor to
                        fraud losses in 2018. Fraud against individuals is typically targeted against elderly and
                        vulnerable people. Fraud is increasingly being committed online whereas previously this was
                        mainly committed through phone, post, or in person.

                    </p>
                    <p class="text-justify ">
                        The fraud act 2006 came into effect in 2007 which gave a statutory definition of the offense
                        and defined it into three classes: false representation, failure to disclose information,
                        and abuse of position.
                    </p>
                    <p class="">
                        <b class="mt-3">Responsibility</b>
                    </p>
                    <p class=" text-justify">
                        In relation to the prevention of fraud, following are the responsibilities of senior
                        management/directors:
                    </p>
                    <p class="">
                        <b class="mt-3">Directors</b>
                    </p>
                    <p class=" text-justify">
                        The directors are responsible for establishing and maintaining a sound system of
                        internal control that supports the achievement of fraud policies, aims and objectives.
                    </p>
                    <p class="">
                        <b class="mt-3">MLRO</b>
                    </p>
                    <p class=" text-justify">
                        Overall responsibility for managing the risk of fraud has been delegated to the
                        MLRO. Responsibilities include:
                    </p>
                    <ul class="">
                        <li>Undertaking a regular review of the fraud risks to ensure that new typologies are
                            updated in the anti-fraud policy.
                        </li>
                        <li>Establishing an effective anti-fraud response plan, in proportion to the level of
                            fraud risk identified.
                        </li>
                        <li>The design of an effective control environment to prevent fraud.</li>
                        <li>Establishing appropriate mechanisms for:</li>
                        <ul>
                            <li>Reporting fraud risk issues</li>
                            <li>Reporting significant incidents of fraud or attempted fraud to the Board of
                                Director Directors;
                            </li>
                        </ul>
                        <li>Making sure that all staff are aware of the Anti-Fraud Policy and know what their
                            responsibilities are in relation to combating fraud;
                        </li>
                        <li>Ensuring that appropriate anti-fraud training is made available to Directors, staff and
                            Agent / Partners as required; and
                        </li>
                        <li>Ensuring that appropriate action is taken to minimise the risk of previous frauds
                            occurring in future.
                        </li>
                    </ul>
                    <p class="">
                        <b class="mt-3">Management Team</b>
                    </p>
                    <ul class="">
                        <li>Ensuring that an adequate system of internal control exists within their areas of
                            responsibility and that controls operate effectively;
                        </li>
                        <li>Preventing and detecting fraud as far as possible;</li>
                        <li>Reviewing the control systems for which they are responsible regularly;</li>
                        <li>Ensuring that controls are being complied with and their systems continue to operate
                            effectively;
                        </li>
                    </ul>
                    <p class="">
                        <b class="mt-3">System Enhancements-Preventing Fraud</b>
                    </p>
                    <p class=" text-justify">
                        To protect consumers from being victims of scams, the consumer when processing a transaction
                        will be presented with a transaction receipt with a fraud warning, he will need to read this
                        warning and sign the receipt. The transaction will be canceled if the consumer does not read
                        this warning and sign the receipt.
                    </p>
                    <p class="">
                        <b class="mt-3">Consumer Victim Fraud</b>
                    </p>
                    <p class=" text-justify">
                        Consumer fraud refers to criminals deceiving consumers, convincing them to transfer funds
                        for a scheme or through social engineering. A number of different types of scams are used by
                        a criminal, the victim believes that he will receive a financial benefit or that they are
                        helping a relative or a friend. Elderly or vulnerable consumers are typically targeted by
                        fraudsters but anyone could be a victim.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Most common types of consumer fraud are given below:</b>
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Rental Property Scam</b>
                    </p>
                    <p class=" text-justify">
                        This type of fraud is usually targeted at foreign students. The avenues used are gumtree and
                        other sites used to advertise the property. The fraudster will set up an advertisement for a
                        property with a rental amount well below the market rate (too good to be true), and pictures
                        are used for other properties found on the internet. Due to the competitive pricing of the
                        property, the fraudster will receive a number of queries.
                        If the victim requests to view the property, the fraudster will claim he is out of the
                        country and will request for a deposit to be sent to ensure that he can reserve the property
                        as demand was high. When the money is sent, the fraudster disappears. The property never
                        existed.

                    </p>
                    <p class=" text-justify">
                        If the victim requests to view the property, the fraudster will claim he is out of the
                        country and will request for a deposit to be sent to ensure that he can reserve the property
                        as demand was high. When the money is sent, the fraudster disappears. The property never
                        existed.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Grandparent Scams</b>
                    </p>
                    <p class=" text-justify">
                        A fraudster claiming to be a relative in distress or representing the relative such as a
                        lawyer or law enforcement will contact the victim. The relative of the grandparent claims
                        that she is in trouble and needs their grandparent to send them funds that will be used to
                        pay hospital fees, lawyers’ fees, or other fictitious expenses.
                    </p>
                    <p class=" text-justify">
                        The victim is advised by the fraudster not to tell anyone, to only inform the grandparent.
                        Calls may be received at night to confuse the victims.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Unexpected Prize and Lottery Scam</b>
                    </p>
                    <p class=" text-justify">
                        This scam involves a request being received to pay a fee in order to claim a prize or
                        winnings from a competition or lottery that has never been entered into by the victim. The
                        fraudster will contact the victim via mail, telephone, email, text message, or through
                        social media claiming that the victim has won a fantastic prize in a competition or
                        sweepstake that the victim does not remember entering.
                    </p>
                    <p class=" text-justify">
                        The prize could be a holiday, electronic equipment such as a laptop or smartphone, or an
                        international lottery. A fee is requested by the scammer to release the funds. They will
                        often claim that the fees are for insurance costs, government taxes, bank fees, or courier
                        charges. The scammers make money by continually collecting these fees and stalling the
                        payment of winnings. In order to avoid victims from further looking into this or asking
                        someone about the scam, fraudsters will urge the victim to keep the information confidential
                        and to respond quickly.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Advance Fee Scam</b>
                    </p>
                    <p class=" text-justify">
                        The victim pays a payment in advance for a promise of goods or services such as a loan or a
                        credit card. After the funds are sent by the victim, the goods or services are never
                        received. The victim is contacted by mail, phone, fax, or email.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Mystery Shopper Scam</b>
                    </p>
                    <p class=" text-justify">
                        Newspaper ads and emails are used to create an impression that mystery shopping jobs are a
                        gateway to high-paying jobs. Often websites are created where a victim can register to
                        become a mystery shopper but a fee has to be paid to obtain information on certification
                        programs, obtain a list of mystery shopping companies, or guarantee a mystery shopping job.
                        The certification offered is worthless, the list of mystery shopping companies can be found
                        for free online and genuine mystery shopper jobs are listed on the internet.
                    </p>
                    <p class=" text-justify">
                        The shopper may also be sent cheques by the fraudster with a request to bank the cheque and
                        to send back an amount. The cheque does not clear and the victim would have sent back a
                        portion of the funds and would be responsible for the bounced cheque.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Employment Scam</b>
                    </p>
                    <p class=" text-justify">
                        Employment sites are used to recruit victims. The victim believes he has applied for a
                        genuine job. The fraudster then sends a cheque requesting the applicant to the bank to cover
                        the expenses of the credit check, application fees, or recruitment costs. The fraudster will
                        request the victim to use the funds for these expenses which will be required for the job
                        and to send the remaining balance back. The cheque will bounce and the victim will be
                        responsible for the amount of the cheque.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Tax Scam</b>
                    </p>
                    <p class=" text-justify">
                        The fraudster will contact the victim demanding a tax payment, threatening the victim with
                        an arrest, fines, deportation, ceasing of property, etc.
                    </p>
                    <p class=" text-justify">
                        The victim will be required to make an urgent payment through a money transfer service
                        provider to avoid the action being by the government agency. This is not how government
                        agencies operate, tax demands are always sent through the post.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Relationship/Romance Scams</b>
                    </p>
                    <p class=" text-justify">
                        Victims are targeted through online dating apps or social networking sites. Romance scammers
                        create fake profiles on dating sites or contact targets through popular social media sites
                        like Facebook, Instagram, etc. The scammers will socially engineer the victims, striking a
                        relationship with their targets to build their trust, this can sometimes go on for months.
                        The scammer will eventually make up a story and ask for money.
                    </p>
                    <p class=" text-justify">
                        Common stories are: working in the military, working as a doctor, requesting payment for
                        surgery or emergencies, paying off debts & paying for travel or a visa. The victim is
                        requested to send a money transfer. The victim at this point may have become so emotionally
                        involved that it may become difficult to deter them from sending money. Ask the victim to
                        talk to a friend or relative about the situation and refuse the transaction.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Tech Support Scams</b>
                    </p>
                    <p class=" text-justify">
                        Scammers will usually contact the victim either through phone calls or through pop-ups on
                        the web browser. When phoning, the scammer will claim he is calling from a well-known tech
                        company such as Microsoft and will inform the victim that they have an issue with their pc
                        such as a virus. They often ask for remote assistance and will demand payment via a money
                        transfer service provider for a problem that never existed.
                    </p>
                    <p class=" text-justify">
                        The pop-up on the victim system will claim there is a system error or virus issue and
                        request a call to a number where again the scammer will demand payment for a non-existent
                        issue. Scammers may also try to get their website to show up on online search results for
                        tech support.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Charity Fraud</b>
                    </p>
                    <p class=" text-justify">
                        The victim is contacted by a fake charity or someone claiming to represent a genuine charity
                        with a request for payment through a money transfer company. Recurrent payments may be
                        requested. Genuine charities do not request for payment to be made via a money transfer
                        service provider. Victims may be contacted by phone, email, or post.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Family Emergency Scam</b>
                    </p>
                    <p class=" text-justify">
                        Fraudsters will pose as relatives or friends, claiming that they have an emergency and
                        require funds to be sent urgently.
                    </p>
                    <p class=" text-justify">
                        Common scenarios used: to pay for hospital treatment or to leave a foreign country. The
                        scammer will gather information on the victim from social networking sites or may hack the
                        email of the victim and obtain information on contacts or hack the email of a relative.
                    </p>
                    <p class=" text-justify">
                        They may also involve other crooks that claim to be police officers or lawyers.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Immigration Scams</b>
                    </p>
                    <p class=" text-justify">
                        A scammer will claim to be a government official when contacting the victim and have access
                        to private information on the individual which he will use to convince the victim that the
                        request is genuine. The scammer will then demand payment for resolving any immigration
                        issues that the victim may declare. The victim will be threatened with legal action or
                        deportation if he does not comply. Immigration officers do not collect money or payments by
                        phone or through money transfer service providers.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Fake/Fraudulent Cheques</b>
                    </p>
                    <p class=" text-justify">
                        The Fraudster will send a cheque for an amount more than what the victim expects to receive
                        for a product or service. The fraudster will request to bank the cheque and send back the
                        excess amount through a money transfer service provider.
                    </p>
                    <p class=" text-justify">
                        The cheque will bounce and the victim will be left out of pocket. As described earlier, the
                        victim may also be sent a cheque to cover the expenses for accepting employment, purchases,
                        etc. & which will be left out of pocket when the cheque bounces.
                    </p>
                    <p class="">
                        <b class="mt-3">Telemarketing</b>
                    </p>
                    <p class=" text-justify">
                        This refers to the marketing of goods and services by telephone, usually unsolicited to
                        potential customers. This covers a number of different fraud types where consumers are
                        contacted by phone e.g. charity fraud, lottery scam, internet purchases, immigration scam &
                        advance fee scam.
                    </p>
                    <h2>Preventing Consumer Fraud</h2>
                    <p class=" text-justify">
                        The most important indicator that a consumer may be a victim of a scam is that they would
                        not have met the receiverx. Usually, social engineering can last for months/ years and the
                        criminal will not ask for money initially. The aim is to build trust and have the victim
                        emotionally involved at which stage the criminal will ask for money. It is important to
                        familiarize yourself with the various scam types which are discussed later in this document
                        so that victims can be identified and helped quickly.
                    </p>
                    <p class="">
                        <b class="mt-3">Common red flags indicating consumer fraud:</b>
                    </p>
                    <ul class="">
                        <li>Consumer has found a once in a lifetime deal, seems excited</li>
                        <li>Consumer may not have sent previously, enquires about the process for sending
                            money
                        </li>
                        <li>Consumer may indicate that they money is being sent to resolve an urgent emergency</li>
                        <li>Consumer may not be able to provide info on source or purpose</li>
                        <li>Elderly or vulnerable consumers sending to unrelated individuals</li>
                        <li>Consumers sending a number of transactions in a single day or over a number of days</li>
                        <li>Change in sending pattern if sent previously</li>
                    </ul>
                    <p class=" text-justify">
                        <b class="mt-3">If suspicions are raised in relation to a consumer being a victim of fraud, investigate
                            further:</b>
                    </p>
                    <ul class="">
                        <li>Inquire from the consumer if they have met the receiver</li>
                        <li>Ask the consumer about his relationship with the receiver
                        </li>
                        <li>Can the consumer provide information on the purpose of the transaction, does
                            the consumer appear confused?
                        </li>
                        <li>Does the consumer become emotional when probed further?</li>
                        <li>Elderly or vulnerable consumers sending to unrelated individuals</li>
                        <li>If the consumer indicates that he has received an email from a relative who has an
                            emergency, request the consumer to call the relative and confirm
                        </li>
                    </ul>
                    <p class=" text-justify">
                        <b class="mt-3">Take the following action if you suspect that a consumer may be a victim of fraud:</b>
                    </p>
                    <ul class="">
                        <li>Refuse the transaction</li>
                        <li>Inform the consumer that this transaction may be linked to a scam, call the {{ config('app.company_name')}}
                            head office for support in advising the consumer
                        </li>
                        <li>Report the incident to the {{ config('app.company_name')}} head office</li>
                        <li>If a vulnerable consumer is at risk, submit a SAR</li>
                    </ul>
                    <p class=" text-justify">
                        Differentiating between victims and fraudsters:
                    </p>
                    <p class=" text-justify">
                        A number of scenarios have been provided in relation to consumers that may be victims of
                        fraud but a fraudster may also visit a location to collect funds. Common signs to indicate
                        that
                        the consumer may be a fraudster:
                    </p>
                    <ul class="">
                        <li>The ID being used appears suspicious/ fake</li>
                        <li>One to many transactions received by the fraudster</li>
                        <li>No relationship between the sender and receiver</li>
                        <li>Consumer may be reading from a phone, has a list of control numbers</li>
                    </ul>
                    <p class=" text-justify">
                        If there is suspicion that a fraudster is at a location, the transaction must be refused,
                        {{ config('app.company_name')}} will need to be informed immediately so that the transaction can be blocked. A SAR
                        will need to be submitted.
                    </p>
                    <p class="">
                        <b>Agent / Partner Victim Fraud</b>
                    </p>
                    <p class=" text-justify">
                        Agent / Partner victim fraud is defined as deceptive and fraudulent business practices that
                        cause Agent / Partners to suffer financial losses. An Agent / Partner can be targeted in a
                        number of different ways. Some of the most common ways in which an Agent / Partner can
                        be targeted are given below:
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Hijacking of PC</b>
                    </p>
                    <p class=" text-justify">
                        Hijack refers to taking control of a pc through malware and trojans. The victim may visit a
                        malicious site where software is downloaded inadvertently or malicious software is
                        unknowingly downloaded through an email, by clicking on an attachment. Using keyloggers,
                        the hacker is able to record personal information such as passwords. This can compromise
                        the username and passwords of an Agent / Partner.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Requesting Remote Access</b>
                    </p>
                    <p class=" text-justify">
                        A fraudster can call claiming to be from {{ config('app.company_name')}} and requesting remote access to help
                        with an issue or to conduct an update, username and password of the Agent / Partner will be
                        requested. Common PC remote access software may be requested to be downloaded such as
                        team viewer. The fraudster could also ask the victim to turn off the pc while he works on
                        the
                        pc. The fraudster will then conduct a number of transactions. The Agent / Partner will only
                        realise that the transactions have taken place when he reconciles the banking by which time
                        the transaction will have been paid.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Conducting a Test Transaction</b>
                    </p>
                    <p class=" text-justify">
                        Agent / Partner receives a call from someone claiming to be from {{ config('app.company_name')}}, the Agent /
                        Partner/operator is requested to conduct test transactions but the transactions are actually
                        real and are paid out.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Phishing Pages</b>
                    </p>
                    <p class=" text-justify">
                        A hacker will send a login page for Gmail, Facebook, PayPal, etc which looks exactly the
                        same as the real Facebook or Gmail login page. The link can be sent through text or email.
                        The victim may not realise that his password has been stolen. This can also be used to
                        propagate malicious software to a computer & gather personal information on the victim.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Phone Spoofing/ Phone Hijacking</b>
                    </p>
                    <p class=" text-justify">
                        Fraudsters hijack or imitate phone numbers, either to imitate a person, business, or
                        department to get money or information. Or to appear like a local or legitimate number to
                        increase their chances of getting through to their victim. Even if the fraudster claims he
                        is calling from {{ config('app.company_name')}} and the number being called from appears genuine, it could still
                        be a scam. Crooks are using phone hacking and hijacking to conceal their identities during
                        phishing scams.
                    </p>
                    <p class=" text-justify">
                        <b class="mt-3">Underpayment</b>
                    </p>
                    <p class=" text-justify">
                        A consumer who comes in to process a transaction may look for busy times so that the Agent /
                        Partner is distracted. The fraudster is looking for the transaction to be processed before
                        the funds are checked. He may leave the money on the counter while the transaction is
                        processed.
                    </p>
                    <p class=" text-justify">
                        When the transaction has been processed and the Agent / Partner checks the money, he finds
                        that it is short. The fraudster will request to visit an ATM to withdraw the money but will
                        not
                        return. The recipient will be looking to collect the funds quickly to avoid the transaction
                        being
                        cancelled. Even if the payment number has not been provided, if the pc screen is visible,
                        the
                        fraudster may have noted this down.
                    </p>

                    <p class="">
                        <b>Preventing Agent / Partner Victim Fraud</b>
                    </p>
                    <p class="">The following measures can be taken to prevent Agent / Partner victim
                        fraud:</p>
                    <ul class="">
                        <li>Installing a firewall and an anti-virus program. Ensuring that they anti-virus software
                            is regularly updated.
                        </li>
                        <li>For suspicious emails, hovering the mouse over the email address will provide details
                            on the intended recipient e.g. an email from {{ config('app.company_name')}} may show as {{ config('app.company_name')}} when
                            viewing the email but when the mouse has hovered over the address, what is shown is
                            completely different. Delete this email.
                        </li>
                        <li>Hovering the mouse over suspicious links, again this will show where the link is
                            directed.
                        </li>
                        <li>{{ config('app.company_name')}} will never request the username or password of an Agent / Partner or
                            request remote access unless a complaint has already been logged. If such a request is
                            received, no information should be provided which will allow the fraudster to have
                            access to the system.
                        </li>
                        <li>Agent / Partner should be extremely wary of emails that have generic greetings,
                            unsolicited correspondence, requests for personal information, have bad grammar or
                            spellings.
                        </li>
                        <li>Agent / Partner should Never process a transaction until the funds have been checked.
                        </li>
                        <li>Agent / Partner should Never accept a request to access the pc or give out the
                            username of password.
                        </li>
                        <li>Never accept a USB or CD with consumer details or for installing software.</li>
                        <li>If the caller provides a number to call, Never call this number.</li>
                        <li>Agent / Partner should Never leave the PC without first locking it.
                        </li>
                        <li>If an operator leaves, the log in codes should de-registered asap.
                        </li>
                        <li>Operator ID’s and password must never be shared.</li>
                        <li>Keep the computer screen hidden from consumers, Agent / Partner should Never have
                            this consumer facing.
                        </li>
                        <li>Unauthorized individuals should not be allowed behind the counter.</li>

                    </ul>
                    <p class="">
                        <b>    Reporting of fraud</b>
                    </p>
                    <p class=" text-justify">
                        All fraudulent activity identified will be reported by {{ config('app.company_name')}} to action fraud:
                        <a href="https://reporting.actionfraud.police.uk/login">https://reporting.actionfraud.police.uk/login</a>
                        <br>
                        For vulnerable consumers or where there is a suspicion that a fraudster may be collecting
                        funds in the UK, this will also be reported to the NCA.
                    </p>
                </div>
                <div class="col-12 col-md-4">

                    <!-- Card -->
                    <div class="card shadow-light-lg">
                        <div class="card-body">

                            <!-- Heading -->
                            <h4 class="text-primary">
                                Have a question?
                            </h4>

                            <!-- Text -->
                            <p class="fs-sm text-gray-800 mb-5">
                                Not sure exactly what we’re looking for or just have a query? We’re always available to
                                talk and help you with your money transfer needs. Anytime!
                            </p>

                            <!-- Heading -->
                            <h6 class="fw-bold text-uppercase text-primary mb-2">
                                Call anytime
                            </h6>

                            <!-- Text -->
                            <p class="fs-sm mb-5">
                                +44 124 5953 337 <br>
                                +44 124 5953 338<br>
                                +44 734 140 5879 (Whatsapp)
                            </p>

                            <!-- Heading -->
                            <h6 class="fw-bold text-uppercase text-primary mb-2">
                                Email us
                            </h6>

                            <!-- Text -->
                            <p class="fs-sm mb-0">
                                 info@oriumglobalresources.com
                            </p>

                        </div>
                    </div>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <section class="pb-10 pt-10 pt-md-10 bg-dark">
        <div class="container">
            <div class="row  justify-content-center">
                <div class="col-12 gy-5 col-md-10 col-lg-8 text-center">

                    <!-- Badge -->
                    <span class="badge rounded-pill bg-gray-700-soft mb-4">
              <span class="h6 fw-bold text-uppercase">Get started</span>
            </span>

                    <!-- Heading -->
                    <h1 class="display-4 text-white">
                        Need Help?
                    </h1>

                    <!-- Text -->
                    <p class="fs-lg text-muted mb-6 mb-md-8">
                        We are always here for you!
                    </p>

                    <!-- Button -->
                    <a href="{{ url('contact-us') }}" target="_blank" class="btn btn-primary lift">
                        Contact Us <i class="fe fe-arrow-right"></i>
                    </a>

                </div>
            </div> <!-- / .row -->
        </div>
    </section>




@endsection
