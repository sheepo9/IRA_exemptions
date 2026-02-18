<!DOCTYPE html>
<html>
<head>
    <title>Official Request Letter</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            margin: 50px;
            color: #000;
        }

        .header {
            text-align: center;
        }

        .logo {
            width: 90px;
            margin-bottom: 10px;
        }

        .ministry {
            font-weight: bold;
            text-transform: uppercase;
        }

        .top-details {
            width: 100%;
            display: table;
            margin-top: 20px;
        }

        .left-details {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .right-details {
            display: table-cell;
            width: 50%;
            text-align: right;
            vertical-align: top;
        }

        .address-block {
            margin-top: 30px;
        }

        .subject {
            font-weight: bold;
            margin-top: 25px;
            text-decoration: underline;
        }

        .content {
            margin-top: 15px;
            text-align: justify;
            line-height: 1.6;
        }

        .signature {
            margin-top: 60px;
        }

        .footer {
            margin-top: 50px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <!-- LOGO + HEADER -->
    <div class="header">
       <div style="text-align:center;">
        <img src="{{ public_path('images/logo.png') }}" width="100">

        <h4 style="margin: 5px 0;">REPUBLIC OF NAMIBIA</h4>
        <h5 style="margin: 0;">
            MINISTRY OF LABOUR, INDUSTRIAL RELATIONS AND EMPLOYMENT CREATION
        </h5>
    </div>
    </div>

    <!-- LEFT + RIGHT DETAILS -->
    <div class="top-details">
        <div class="left-details">
            Private Bag {{ $private_bag_left ?? '2094' }}<br>
            Tel: {{ $telephone ?? '(061) 206 6111' }}<br>
            Fax: {{ $fax ?? '(061) 212 323' }}<br>
            32 Mercedes Street<br>
            Khomasdal<br>
            WINDHOEK
        </div>

        <div class="right-details">
            Private Bag {{ $private_bag_right ?? '19005' }}<br><br>
            <strong>Our Reference:</strong> {{ $reference ?? '6/6/1' }}<br>
            <strong>Date:</strong> {{ $date ?? now()->format('d F Y') }}
        </div>
    </div>

    <!-- ENQUIRIES -->
    <div style="margin-top:20px;">
        Enquiries: {{ $enquiries ?? 'R. Thomas' }}<br>
        E-mail: {{ $email ?? 'Roseline.Thomas@mol.gov.na' }}
    </div>

    <!-- RECIPIENT -->
    <div class="address-block">
        {{ $recipient_name ?? 'Mr. Benhardt Kukuri' }}<br>
        {{ $recipient_position ?? 'Executive Director' }}<br><br>

        {{ $recipient_organization ?? 'Office of the Judiciary' }}<br>
        Private Bag {{ $recipient_private_bag ?? '13412' }}<br>
        Windhoek
    </div>

    <!-- SUBJECT -->
    <div class="subject">
        RE: {{ $subject ?? 'REQUEST FOR ACCESS TO THE CONSORTIUM SOFTWARE AND ONLINE MEETINGS TO THE IT STAFF MEMBERS OF MLIREC' }}
    </div>

    <!-- BODY -->
    <div class="content">
        <p>
            This letter serves as a follow up on the letters sent to your Office dated 
            {{ $previous_letter_date ?? '21st November 2025' }} requesting your office IT division to assist the IT staff member with access to the Consortium for the development of the new court systems.
        </p>

        <p>
            Since there is a standing agreement between the Ministry of Labour, Industrial Relations and Employment Creation and the Office of the Judiciary regarding the development of the new case management system for the Office of the Labour Commissioner, based on the signing of the Non-Disclosure Agreement, the Labour IT Department will join this consortium and make use of the software developed by the Consortium to develop the Case Management System.
        </p>

        <p>
            Hence the request by the Ministry for your Office to assist our IT division with access to the Consortium software and development group. This will enable our IT staff members to familiarise themselves with the software and begin planning for the development of the system.
        </p>

        <p>
            Your continued assistance is appreciated.
        </p>
    </div>

    <!-- SIGNATURE -->
    <div class="signature">
        Yours sincerely,<br><br><br>

        __________________________<br>
        <strong>{{ $signatory ?? 'LYDIA H INDOMBO' }}</strong><br>
        {{ $signatory_position ?? 'EXECUTIVE DIRECTOR' }}
       
    </div>
 <div style="position: absolute; bottom: 60px; right: 60px; text-align: center;">
    {!! $qrCode !!}
    <p style="font-size: 10px;">Scan to Verify</p>
</div>

    <!-- FOOTER -->
    <div class="footer">
        All official correspondence must be addressed to the Executive Director
    </div>

</body>
</html>
