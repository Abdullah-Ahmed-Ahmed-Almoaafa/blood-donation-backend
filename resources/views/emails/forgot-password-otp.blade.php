<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <!-- استدعاء خط Cairo من Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        /* 1. الإعدادات العامة */
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 20px;
            /* خلفية ناعمة جداً لراحة العين */
            background-image: radial-gradient(circle at 50% 0%, #fff1f2 0%, #fafafa 60%);
            color: #334155; /* لون رمادي مائل للأزرق للنصوص */
        }

        /* 2. الحاوية الرئيسية */
        .container {
            max-width: 580px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        /* 3. الترويسة */
        .header {
            padding: 50px 40px 30px;
            text-align: center;
        }

        /* مكان الأيقونة */
        .brand-logo {
            width: 90px;
            height: 90px;
            margin: 0 auto 25px;
            background: #ffffff;
            /* ظل ناعم جداً حول الأيقونة */
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #fee2e2;
            transition: transform 0.3s ease;
        }
        
        .brand-logo:hover {
            transform: scale(1.05);
        }

        /* تنسيق الـ SVG داخل الأيقونة */
        .brand-logo svg {
            width: 50px;
            height: 50px;
            fill: #b91c1c; /* لون الأحمر الداكن */
        }

        h1 {
            font-size: 24px;
            font-weight: 900;
            color: #1e293b;
            margin: 0 0 10px;
            line-height: 1.3;
        }

        .greeting {
            font-size: 15px;
            color: #64748b;
            font-weight: 500;
            margin: 0;
        }

        /* 4. المحتوى */
        .content {
            padding: 10px 50px;
            text-align: center;
            line-height: 1.8;
            font-size: 15px;
        }

        .content p {
            margin-bottom: 20px;
        }

        /* 5. صندوق الرمز (التصميم البسيط والجذاب) */
        .code-wrapper {
            margin: 30px 0;
            position: relative;
        }

        .code-box {
            background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
            border: 2px solid #fee2e2;
            border-radius: 16px;
            padding: 25px;
            display: inline-block;
            min-width: 200px;
            position: relative;
        }
        
        /* نقاط زخرفية صغيرة في الأطراف */
        .code-box::before, .code-box::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: #b91c1c;
            border-radius: 50%;
            opacity: 0.6;
        }
        .code-box::before { top: -4px; right: -4px; }
        .code-box::after { bottom: -4px; left: -4px; }

        .code-text {
            font-size: 36px;
            font-weight: 900;
            color: #b91c1c;
            letter-spacing: 5px;
            direction: ltr;
            margin: 0;
            text-shadow: 0 2px 4px rgba(220, 38, 38, 0.1);
        }

        /* 6. قسم الملاحظات */
        .notice-box {
            background: #f8fafc;
            margin: 30px 40px;
            padding: 20px;
            border-radius: 12px;
            border-right: 4px solid #cbd5e1;
            font-size: 14px;
            color: #475569;
            text-align: right;
        }

        .warning-time {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #b91c1c;
            margin-bottom: 8px;
            font-size: 15px;
        }

        /* 7. التذييل */
        .footer {
            text-align: center;
            padding: 35px;
            background: #ffffff;
            border-top: 1px solid #f1f5f9;
        }

        .footer-logo-text {
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .slogan {
            font-size: 14px;
            color: #b91c1c;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .heart-icon {
            color: #ef4444;
            font-size: 16px;
            animation: heartbeat 1.5s infinite;
        }

        @keyframes heartbeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

    </style>
</head>
<body>

    <div class="container">
        
        <!-- الهيدر والأيقونة -->
        <div class="header">
            <div class="brand-logo">
                <!-- 
                    ✋ ضع كود الـ SVG الخاص بأيقونة المشروع هنا 
                    يجب أن يكون الـ SVG بدون background وله fill="currentColor" أو لون محدد.
                -->
             <svg width="92" height="118" viewBox="0 0 92 118" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect id="image 1" width="92" height="118" fill="url(#pattern0_2115_1022)"/>
<defs>
<pattern id="pattern0_2115_1022" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_2115_1022" transform="matrix(0.00572593 0 0 0.00446429 -0.00388199 0)"/>
</pattern>
<image id="image0_2115_1022" data-name="image.png" width="176" height="224" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALAAAADgCAYAAACjOeypAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAFxEAABcRAcom8z8AAHhNSURBVHhe7X0HgCRHdXZ1mrR5b/d2b2/3kk4JZSEUjEAIgSRb5CAECGRkEfWTo8GAydFgm2CwCQYMmGCECSZI5CQJgSQUUJYux023aWY6/d/3XtXsnpB0e6e704X5Zrqr6tWr9Orr6qrunh7TRBNNNNFEE0000UQTTTTRRBNNNNFEE000sYfx+L4VC19xzCkPt8Em9jJ86zaxi7hwQfC8c7Jt33xea+FIK2piL6JJ4AeBc3p6Fh0ReOef2+otO/uQJS+ByNOYJvYWmgR+EHhOV9eFC7Pk5CSeNkcWwr/7f8uWHWujmthLaBJ4F/HK/u4jD4ni53flqRmvZubQPGl5fMV7E6KaNt2LaBp71xCdWW590TKTHxWDwHHumziJzdIoeNJbhoYeZ3Wa2AtoEngX8P5Dl58wWAme2pIbL05946XGTCWpGSoElUe2lV8ElUg1m9jTaBJ4J3H44QvajgnCF/XnZmk1z0yGZVuCLYfHr1bNCt87910rh8606k3sYTQJvJO4uNb2lAEve2Yly2TqkEPmYR9gJK4lienz4pYTS5WX9RnToima2JMIrNvEPPDivo5lZ7a1vO+QIF2ZZqnJYD4PDCaBfY7GJjQFSoNoeXdH501XDI/eZJM2sYfQHIF3Ao9s77pwKMhO9fLYJDmP/UzIiwmExIPGppZ6ps+vF49vL15sFvxVm0Q0scfQJPA88aqhBScdFubPGzC5n6aByfNcqcv5r2wYjbPcpCBwigXd0rj+qM+1bn6ipm5iT6FJ4PkhOrnQ8oJlxhyWxJg6YO5Ly3H6QBZ7DIPEns4nQGBjFudZ5fDW/OWnDpYXaxZN7Ak0CTwPvH/ZssceHobPKnqpqdopgycf4avAkxE5NxksmstIHJuBQn7KxS0LL0J00857CM1F3A5wXEdH50Wd7R8+NjDHjpoUFA2Mn9lIctkxGKBXSAxfBkJ3BoGXe4UB3wu//8epqTHVamJ3ojky7AAvW7DgWYf45swsxtiL+a1MeB2sVxwQloT2OYvAlsK0tbhulnnJoed1t/8tNEKqNbF70RyBHwB/Nzi48qxS6d9WBEnvZI5xNcdCDXIfOzvdxQ57kJojgUwsENbJBUZiTCXao8ivhdHDBlsqv/756PgaJmli96E5At8/vDNbipceHuWHTGNVllpaKjXJWV5AEwoLcmE1XEQyXgiOxd1UHJslXtJ7Wil6zsOMKah2E7sLzRH4fvCqJUse++hy+L7+tFaqpmSlEpSU1Y0MpaYK3T05DshCYUtwUr+CYcILokMWVtr/9H9jY7dTo4ndg+YIfN8oP7YYvuEIL+2cSnnHDQAxSVGHxugrQ66Sl9JZHUwhKMoCU48zMxBk3YdXghed3tHRpfFN7A40CXwfeO+yofOPDMzjsnrd1BHmpbFMLvoq5hKZvJVp8FwSq4MFHe/N+SbBEZDXa2YwzM++uL/3qUzWxO5BcwpxL5ywoDxwUXv7pw4PTN90yoUbpgKY37ql2RweK0hg8SBC5g+qx51esOCozMtqxnRHeZgG3rKOKLziym3TI4xt4sGhOQLfCy/vWPSyY/z8qMk8NannCx19XmXgPMKRF8QUQoOws4QmY0lWnUZw7BXX6qbw1GqZOcz3j3tkV+slmqCJB4vmCDwHrxpa/qizW8of6s2mK9PgF2cFwjIZWeUimQ2rbHYhZ1Ws30FF+MBDfw0jeSU0phREKweKpV//dHxirSg2sctojsAWvb2m9fRy+IbFftIzSbaBvXqtV0nrk7C8VEZwTisfvdIgI63jsgToQRijrkxBNCQP+0zXErPEM/0ndLW/ofnM8INHk8AWr2tf+rgjguTxWTZtkhxTB26YQsjMgRNYEhUOpwQ6LXCgUMNKVMLRHjJOK1TFBEiYZp6JazVMJcyT/+HQFc2n1R4kmgQGjmhrW3BCFL1uwKsWYyzcgpT0k6UXYunS0RHZkZUP73BrxNs5hEwXoNiQwcKSG7wihacWZ2YwTfzj28qvPWPp0k6qNrFraBIYuHRg4UuW5NmpcQyqZbzwRehizJeRmHTkpiTWhdvs1EDJqWSWLzYO2nRlGiFJEUAkSc+HfaarVXO4l5x0SaX0NubSxK7hoF/EXdrff9JjStGHlnl5ZxXkJRntMCpz3YafoyrjCAlbPyBpSFZ1GhACW13xczS2mcTYWvPYlIuFhwVtbT+9emRsnUQ0sVM42EfgwmNay5ceHpihWp7KzQohIVwZMB1LNeAcuJkQlbF8jEeeQGMI5JRLa40NuvYjfgzLcsPDZjuVeGYwSzqeXKq8ySx6eEWlTewMDmoCf2DFkY9bWfCfUMrrJgYpGwDHlKvCwDkCO20gG+lXpb8ACXt/kUJgHeZNHQu6NK6ZlSZ58udbZ85XjSZ2BgftFOLZhy3qOccE71vpJ8fNZAnmrIGMpLxcRnKJI+Do2QgILzWInbhziTqrR5+GmMCNE8yXN0cIX56VyHDgdAQY86N8eRr6P7luonmHbmdwsI7A/uOrlb9dFqRnmaxuTKrP+RKko5zy4brNkbRBVfE0QkJo1dXU3GZ9uhN3u9zU+DlG41qamsEgO+681vbXQdR85HIncFCOwG8e7HvEXxWK7x8yeU89S8GiULg1O9IqIyXk6zHuSCdCxokuKSta24EyfkhOsltU3UpP9OEyCg51M8R1wC0FxUNWtrbf8qPR0T9DqYl54OAj8FJTem2x9x+PKZgz4yw2qQyfjlxKrwaEgEq2e8XMITtjnN8Reo6uBCGHK1JJNyce4KIx9TLTGfolvxD1bEjN5XdOT0/a6CYeAAfdFOL9yeInLCnkT+cb+WZAJlm6kU/CXxLNMq3BsTlkm+PlJGHuRIGjrazbbFq92sBN/fSSvKR4I63TxVZHRbIkMYtNesaFPd3Nh33miYNqBL54aGjgcaXCRw/18kO4cJObDI5FhHhVpvJZRlr+KRoexmi8vhNC/U6qYc1Dw42duvrVgwZ1SUD09jD3Iz9cOdTa8fufjY6uVt0m7g8HFYFf1df72hNL/oVBvWpAX0hwAqKDnZvTyt76ZUSlb1ZNR05ser9OpI298lVDQkrAOoBmIqOxk8FDrxSDA0BuTeeZ6SqEHYUg6hguxZffPl6rMrqJ+8ZBM4V4VX//SYdG6YsqaRVTBz6sEyhxLBwxnV9CJBw3nN7n6pKJwjVK4ZEbH/xQKHMFyvW6sizk1Cd7F3Ieq42N0xnP1PkcRj0xg5533lMqC58kSk3cLw6WETh840Dvu4/309On5W6YHT85KDYIZjnFHYkojh2RLfno02mHC5G8IpUwtcRHmVOilAESXfw8eCinAsP0cyTRvBnFn+N3FPLQROERPYWW3/12fHyDajVxbxwUI/B7j+w/e2mUXpDFmbx8T4jHCLtrDJpO1iCVcm8uRIeg3E4BBC7Cui5IjVnCcs+xloCQHnGsxMOoDWU+CFTFNGelqR5xZkvh5YtM8zbz/eGAH4HPWNTa85xy1ycOM8nyyUzoZGOsC0dlltRkrBATH3hlVmBVZz2AJrFpGaY+6CmjqL7oRJT4demoY116lMquACldIHlkvin7mYmC4LDD26dv/9+RsRtsdBNzcMAT+B0D/W8+zQ+eG8ex3DDgqVqoAr/jlYOcxq1Q9tARCPGYjinnxBPwMInOOih1RFS/hqy2i+LFO/glVuph60Q9kat+Al83JhJQWdLutf/kyqnxUYloooEDegrx6qWLT31YFL2skCYGswdLCyUj/dyTtMoejRUmMqyMUgiR3eYiVEmnHyrL81RUNCeVsQwu7mavPlDulNR1WbiiKcswnUgwl6jVM7MkDB5xalvA28zN96vdCwfsCNxhTOeli3o/goXbcdU4ASH4K2Fhjez5+zYZOSmVEbYRox9lm/gtrcQnEo6YIrYuY5iHZOh+x2FT2Xyoo7lQRFKLRwUWTsO9b5jjCxecpSAzhSg8bGUpuv7y8anmm33m4IAl8IeHhl52chi8vJDV5FFJ+T8LyEkSLpIUJJw6SiWlq/jEg0hhGsMuxsEmsmJxZndODJc+F1I08voLAjs5d3JukCrw/zgWFMNSGpX6MK/49g0zMzVGNXGAEvhVXX1HndVa/OiSIO6aAnk9PqwjIH2VJCTR7NWHOUQSrw3bqQM/SmNgjqok3l7QgCMjNThPYxmSiz0g5kLK59dGUYWpqc84OeAwPekOSsvKQbTpf0ZHrxLFJg7IOXB4Rnv0ysXFeMWYl9hHJe/VTJBXOCF+Jcscj8BySVydEjiJoxZls/lQ2rhpYfN3GfIGxayrdbl3eqdrAzaInYR9gzWoWZDG/uHlwmsvXjBwOKVNHIAEfuvixY9fUiw+PQBdMj4xbu8DyzhKV/zYQAy6sheBBABHPipYJRvn+Ek0xNjRZRoWJSEMoe4joIhKyC/3KWWA0Hi9hWz1WV1WkiKJxCZxxownNbM0TJc8dkHl7Qg2F3TAATWFOL61tffZC9s/uDTMjzaYJcqdLRDAnc4bIyN3JImLkZ0I6UGaWb+62FwQHnrdsw5zIpR4DshCyqKoIReJDc/d6LBuc8ONnTj8FR7f8uqb1HSWCscc0tV954+3jlyvCgcvDigCv2P5wpc9LPBfXEliL0Nv53LlQbgBKHlmww16qEci4MBlkDSl3yk7Xc3FjdIOoB71IJTBVDNo6Li0zFPoLwLUbzsFl0BHW+40nXrklje+MSbEfSEmNYXomG1JyzdvmR4/qJ8bPmCmEC9YvPi4I4LiJYuS1E9B3syfJRldN98ktpNrpJIOO2qpyGo1WAYoozTOrbhEj2S36ThNcGmoL3rYKEdYQwxrvKaCR/x6sVpHcq2JpMFOfgctX8+MVevmSD9beX53+CEolrAdtDggRuBFixZVXtNafOeRefq4WP4OAMelkJEgQZQUJIMGrEtYvxuV9a8DKIbACa0re5eP8klkJJW41MMmBOQXClouAvRDR/KSVSHTUMJ4WyLVbOaU6MHDsF5SkymG5OebMI9NKQyOGmppv+GnY+M3U/1gxAFB4Hd0dD372IJ5XUdeK1bZ6exndLob3dj5ygjx/QWc1KkIn0RKplHADfE2jjECehAmQYX2EqFjvZCaYafcSEQNoaLkJ3CulNtwmMN2cVI+NyxO66jbQs8HwpVrkukfraqlB+XfeO33BL6wt3flWS2F9y0LshVTvGAq/yRE8rDnSQWhgfrFo/NilatPl/42GjsdES34RkpGgD2amyIjaefyG5F8zJ17PYYkkXzVz5HT+SW4vQu4kdztxZFRGHmKnqsxNQN5tqMz8hb1FgrVy0YnfiJRBxn29zlw8NiWwt8ORN7J0s/8LwBpEnqbAva69DzJIwwA0Plgmwf2aQw2hkkSjVZoRGPE1Vi3h8TeziO/5QoBiuVTxrz1SwJu94I/C+YleaBuOk/WPGxhoipVFrlNbyF50uUOhfKKRA0HUDvqcVSxdNH7+vsfLYoHGfbrEfhNi5edfEopeOegl3dVE3Zyhr5l57vjklRQYjgiix+b0kG8GoVkOhWATC7o6sJJsoMCR3R+9KVSLCE3JUQOJ+H0TdXk5o5i0N+KcCK61FB9yVhcC6mefYiI7Beo64grKaQYHlaajw0CiEcB/NsD/gcH69MZBG2B5y9Yk5kfrqodXD9Bcj293+EMYzpPKHmvGPD9ZTNpioUbR0Idmfi2Gx2AHTHQ97bzZY+Ri7960NU9yMCpANmh0UIKfvjXAiQQCc6/jpVo5ss4H+TxArM+8b/5xZn0wo0186sohLaHRSR0YpIZekzHJzGYJ4thXsxH/jSGAeZPHVaYcDKSVFiscqlRow48sDS/OgqL05oZKJlzLlnY8zxGH0zYb0fgVw0NnX9iaN7UbpKgyg5n16LT2f2EzoGtq5zQHRlAB+RwOkxHCEGcnuTFAEhOXSujjzf4SkFo7kiCe34xNfOaz41svH6oUrljYRg9o9/3sZDkYSEZCSR72dnCBbN+ISWges5jAW+jngTD+FieS1r+g3OH74Vh5h+5qBRd/cuJqYPmrwv2SwI/s2vRkke3Bx8+wk+XTGUZOtA916sdLbNQxwYZrehHV9t4dThfJR2VIKojAXURoyI76okms8tNEeet8cRLbqlmb3vdpnXfofzXk5OrTyqXy4Ol0hnFPJYzAs7z2GHsZf7YpDRk5kogmDc3DraO9FJeI4wNX3eSYHtcjXQPMT1ZajrDoNMPi6Xrg/DHW6an+Q9hBzz2xymE99eVwt+tTP1HTCceTtWkK3uQPU7XhbCnxwL9roTkJmhoCTl02mD1ZHoBqZCFCfTKBQ8V3soN89CsT/PLvjyz+r8gbuCf12340HX1+DvFIAJhcYrHZg8RnYJI5nRZMmVaXgMip8v9bIR7SEjTAQjiuBU/82Q+tTxC+1IzEKZPeUVr+SlUOxiw343Ab+1bdsoprd4/9ef1Fr6QmpC1EDqZHcpRSwZRCWjHO9YqD3Qk1I9C5soyBNKFgKPlnEO7cUsas9pWTB3WZNFd101UX/1vI5N3q4ZiGFPS9tDc0h+WnzgQBe1VMItveOclN1ZIRnp8SGuWw/pIlO6YhcaJX8ONIHZSY/G7yjESexskqTsDr5CHYX9nWrriqurkuMYcuNjfRuDKcRX/H4dCf+E2XoS1o6SMZOhY7U51xW+HNyWMKugoKGIhFjcGZTEHV0guJKEa4iVRZgI4FVMwo1kxuyPPPv6a4Y3XqNb2+MyW8euun66/Z1PiZ2Us6LjUYj6yoWwp2ubvIOXaTYiKeJkCiStCwMaiglJTkatCzkk5ZLRDPTGmP8hPPbmr/HxqHOjYr0bgdy5fdNEpFf/VhVrd47/9yMjIPrTx8m5fbtrXfwHLZyUpICMaQFo1/NBxyUWf2WHj5Tk/KJhbUv+7X926+Z231OszqvWX+NHkxM2nV1oOXVosHs0lFq9K8N3DMtJL5jZjwjqst3tgpwFUQOfys5Dkrq6yl6SQ8B+VMKVCmm4YwgvCIwbaKr/65di29VbtgMR+Q+DHdXUteUZH638eYpLO6QSjmpw77OLtXhBJgyh2b8lDjrgReW5K9evejpOyp4QjXjHwzdrMu/vyyYnXfG509DZRuH/ECwtt1/cXgr8a9NOBjH8YLq9p5YHyl3CX+whOh6R8kne2ArOwMh2FtQ3yXjboM4p5ZUluegtBWxoExd+URn+0bRvmPgco9hsCv3354g880vPPmqjX5KqDzluxaT8CssNeuhYyxotIQT2wQ/6skAqEi3dhpnbpqAbO+Tgvt2BsG8uC7I9T8UffsmnjV1T3gfGH6YmRQ4ulrQuC8LzuwBTqLB9yd3BoPblnQU7ivNoGTQEgwDDTst0ixZHIM8RselSWcfDzB6yBVzdRao5cZrpu+r+xsZuocSBivyDw6xYNnf2ogv/u1rRWmLbzPe1cjL9wpENlrx0oIUbAb4MSTZmENQEF3KkjUL9ckZBRzTcRZDTS7Zn3/Y+Mjr5zQxzP+/nbn01O3vboro72rqhwWkuSgFIYHXlQsBKsjyUdoWOzjeAeXszwXdDCBug0vBqQ9PhKDnBjpF4Y+Dh0iofAueK6qakD8p0S+zyBT20f7H5OR+mzRwTJ8vEsNn4aYoRxHQfYFZwNAfQ5OtjxDgEZeGXIsiOXKlgwgA2skbtmiPRTjGJ5asrg2F15cNvlydSrvzWy7RbVnzfybX7450MLwXEDnr8i5zVrKYovtGaJshOisj4SlqkAPxonO1tngShSz5LWwrZU06Ac/udHmiemJ/QXZUHo/e/o+I8R02jxgYJ9nsAvXdjxt48o+C8K05pJ0Os6dUDXSVdoBzoiCESOHcL37i25nsr0Fn/hg4PZKkZI/SFo6HPq4Mc3Jfm737xu07dUaedw98zMxMpKtA6j8GN6jNeZkVyshnzmzOCdR1wlpxM12gFBg9j2KBQuS6Td0xFyYxTGwdeSoz1BdEh7W88vrhobOeD+iw5N3Hdx0eFLlz2iHL24I6uaGv/LQjprlrzah9qh2n3sO+28RphKElDKaCKnQQLwoMDIiyiu4kle/oTd+FWTYeG2ygTf+frU1BeZw67iPeuGf3pbmn1yq+/XQs4aeAUFppeRVuoG2CpJdcXPy2KMpwBfaaOtP76sN5su6dQg4uX0h2cRvcTomW1Y8A6EWc+jytEbBo0pi+IBhH16BH7Vwq63HpOlT83jutxxsz/7BYSKgNCZQQEd9qWQ2kK6VsJKVElJ0lIO0KVUcwKBMUlN/cS0I7yhHq76eRy//Itbtmx3w2JXsCFpufWYYn5Uf2DkJ/EpF1pkJSCOJaZWjzv69QATv1TYKoiSCBQI8tlgetgOjdfRnaEwS0yb8Y/sKVVWXT4x8UeI9hk849DBxa9o7zjtWX1dz3ry4MLnPHZgoGvlkhPvuXrdHfN6ecs+S+C3rlz4+BN9/x0LklpLVfqK/ySkzy9oF7F7LOB11BYaSpTrPnoZa/2UN+IdOPIynJkETogJ83RWNH+czj/0ps3rvq46Dw4b6pPTKwJ/68KgfHZ3ZFo5lZCn4VCeTinYBu5RU14tgcuNZwVlOKEHHkMNVxsrkBbyQBAZ86A+ysAJpT1MTVAsHz4ZRt+7dWrqIf/1xgVDQwOv6+l+5aPD8J3HRsFFS/P0iSuz7BGLwuCcIJ8qXLZh8y+hJuvYB8I+SeBHtA0seHol/MhhxhzD/1BL5BoqNvSNHUN1ZKIfrvuwoxkvXcuOhMtTtSRkjKTRg4CQzodfbhQjbYo5L98J2WEK5rrU/9HbNq5607gxu+352l/P1O46oaMrXxiFZ7TnachHLrUmqCk8brQVKUnL6oqCnh9UMCuWKBmJ0U4I5coJY63DnRwgaCPdBVGwoFQoJN8dHr2csQ8V3jO46ClPbok+clTgXzTk5QPFLG8tYuUcxblpDeLCxry+fFvU+t93TExss0nuF27g2qfw3J7oWUNeeKbB/K3OY2zu3wGwY9DRDM92v/YZ53/bzwehLKSdu9k09Do/HWz8A+52PzLrU7PlV1Pjb1ttzG6/9PTKZNWnbq9n3/M8++eKYB6rzEciuYCUGmEnVbIBuuK1TRA/IJf74HIvPhcBOLnuPVNHOcV63RxpvAvfsHDhqaK091H+zIplrzynpfjpY0x2eiWLvWqaYHGeYo2TmWk/N/U4M62JqSzvDub1h4/7HIFfurBjxVFe/sIFJg6nYHr+TEc6mh0Bj3a63UhkCGc7mKO0kpt/UEhdJYHNAX59wJydr2H+TxznoyRQCf5Jv2x+k+Xv/PjIyNWSaHdjg5n+TTz23tuD4J5CEGBkxBkG1dMHhnw7WrINUnHs2Wg5v0iFZQqlzQHxocOAbCpriOhXEcK5vKp1HHOJRXncf3K55dUQRxq71+D959Klr35E5H1o0MQLa/VU/iuaHRGjpinqyLZ6aWAqOBW2JuG8Zgf7HIEf3trynMV+egyPSj5DoOOMToVkcJUemt3kQy9U6GIPM7g4oSn2si6nJhXokU1DnItirEbmhTAyN6bpD1+7dvV/SNQewsfWj1/7+5nqJ8Zg/gg9wLKlt7QBAuUo2gKRHpK6SRvkyzAPXiuzKe4T0CHZeTcwxVltcck7751Lep9sY/cGvH9eMnjpyZH/lr40jSZIWhyw2p9ac90oSE0EHoe5KSKwQ+xTBH5FT8/Dl+XBxYXMBFy4cWGlxLPQA1bCcrnMDTXOAgiQA3Jvg0FpnpLAdbPKNUzFgL/GxCjYEnhmXS0Y//n4Vr53bI+/vvS/1278txuq+XcCr2DKOFJlUScxnFJou3WKgDiESVS9rIY45xd97OlHW5xc46gLP+Q8y/DDtBOQLUyzloeFLX/XJa9R3vN4w6JFZx8fBe9ZECaVSQwW/PuElO+IY/ew36QfdeMCNgo8v5xm+90IXDylVLpksR8sn0EjM1SNHQR7w6Xx1S8tdqdUB9FpeHVDx7nRSeKsjttoLD6ry0fUI2wTXtHcPZN++NMj2/bM1OFe+JMxU98fG/n7exLvzgo6TeupPSoP5xDsVAslNPRsXwtkqmE3ym0y5uGmVjyYmR3TQxFL1AyjcGyGjHnMPyxddJ6o70Gc3mG6zmirvO6YQtDOh7BkeoQKad+4Q1R9qDb2ngnR/1Fenxc39xkCv3Vg4PSBQvh0XrPkC6lpdfnhozSJrsL1ncbgYxvN3qJRGqCR+IECp1oOMoKLEUOMTKHJ/NiUQeE7q7Xf/PPme/5dtfYOvjk5efMf8vw9G7BwjHilhVMZNEGIh3jtXlRe6q+NoGkYr5u2UTqfmvbA5iYSJoWMYJjgcxiTeWo6/LS0Mipe8oRFi3ps1B7Bhd1Lnr7czx/Lq0mZCVE+DlNsUkdpBLVYd+71FnsAM3TUectnx9hXCFw6OvQv7AvS3ilTR8PYGttI7CVMPzvMboR2DvxCVvhJTJFoWO2jEkbTR3DOy5GIl7Ha/MCsMvnINbXqezAqbrYqew1vXrXqazfXs+8VSWK5DoFFndSbYHsY0BD3bLEs3iSsrnMIehux8JDeDtRniD+Wq2JBt9B4p51TKT5NIvcAzmht7TksCC7u9RKfvxzndEZh+5PtE6+0CgJtL59BqhSL+88U4i2Leh/dE+bn+fwxJBpBYrrTjJssaMeon2BDpYOkkzSW+7mTCyG4HNoks27UY9jHnLPgJWYmL5o7atkX3rt1Kx92eSgwffXY1LvvTvx15SCS5xekHayrO4sg7DY2TxbvbJa0x9oLrqSjH0ahXSQFvyQON36x0eWfi7eZvLQy855/8YIFA9Te3Xhmd9s5i4L0lGqSSLnyMhnUmV0i9eZH2sB6af3Ej7ldFib7xyKO9+ePj0ovwNy3t5ayDTr3dWD7GOYmXGQ7sdP22s7ljrAyNQ6hnao61ocMOYXg4V3Cafv2LL7651PbPokgSn9o8MmJkaturCcf3GTYax4qQhIiAhtbou2UABtCXgNsh4vBB2cVWcBpMlHV9nNT6BmLUsgwzOdpbHpNdtIpra174kegfr9vnt3lG7/K50ts3dmfrKeEpd4iFmh7dJoTJPvJVYgXLl78mIWh99dhjNEX1ufpUed51ti2ddp++FljjjISVr8e0nQhw66xSViNwtWtKAC89hrhNLUpjbbcWY/f+1/btt0hEQ8hPlWf+vztWfZDz8c8kX+xxekEKq5XFbTt3FJxkYC7hly81k8Ka7S4dtMRmwG1He861rDeKPtesT8InnthR8dyiHcbntHdesTCsHAqL3LLvy5JfVg2PdIx0s9yNGq3iF/iMxPM5PN78OghJXCfMS0ri/7FvUHWMYlaSxtlN9smDWqzpaOkk+YoqVA2niq1ezRe9NQrLq9tJCBviMAUCLw69b/6hg0bvm81HlLcOjw8ceP4to/fk+RbowBTHGcB2wTZ0B53rDYAv5vnSpxAG02rCWUaduBOdamcYBqV4PS+IM9OemRby19rxO7Bw6PCWT1+viBGGcJUqTfJrN65mBv2caTh69dMuu+PwC/s6zlzMPf+Rm4Z88I2ZDy9a4OkxY6bYns7KEs3uE6xUbI5MI6dOrvnKIY90vOaagETiA1xcvuVE2NfgPo+83uxD46O/vSOavKpqSxMSzxjoM56JWYW7hDVa70E7TXbjRovtG34fUyV2Hb69W6lEiX1AlPLE9NtksJAITr/SUO7by68vFw+siPw5WaU1JhfqbPWWvrXsllk0lypoYJvSZwHHkoCFw8pFC8e8LPKDBsGC9uxQVw5fWpQmix+0aNHG61e7VC9NGbTilE0jjYSXVoGo0EIwYgJs43V+mc+Mb71WlHbdxD/ZmL8E6vT7Ffy2z20JkF99QUp0nx1qenaCyHPLCJjPAxH2wkjqAOf2g7TBrSfUxDaR2wEMtdBbk5Xuo05+VF5YXeNwsVFYbC0wLJYJwhclbhpmHsN6NwcG1y2JURk0Y/mNbA8ZAR+YXfljL5SfjYvG7ExUhFhmTqc0KufDUNFxdV4t2c6+agqoB0mLjJROY1CrcwUUqwoMCrcldSuvGzLNv44s5FyX8E3pqc3/jlO/mN95k/yQlIA9nEwcm0UwipDG7V3jXC2EmLTSKKn1nKghDcTuHF9QTNz8dzjJeUVUfiEk41pV81dx4q+vg6TJYNaMS1f+pNh6zDIGI65rKa8kBF+9hQR8pLFPPCQEfi4ltbzl3p+ywxXbtI7Ooo05mvYeIlFgrLZponxxVEDUAiPEtnqWJl4rctfQQQY1Yazwthd9fgDPzQz++wL8N6xYcN3Vnve/8R+wURsO4XSYLvJnTslqbaXjWTcbNNpFzLA2YVSjuqy0gdj5tqKQx1/+t/th48/b9myMyl+MHhMkC7G3PeIOkZ8Z3+Wz/JkkgCPVImwA5XWmbEyCudBzn/G2zEeEgI/saO4fLlfelIUB/I7NzG0tI47NoXE1QZLa7FZetu9NcZc46BjGZa8rMsO5ojlZfyZuWemQs/cXYv/7x2bhx/S52HngclrJ6c/urpubg3CEK2T64u6WY/zNmzBDTsxyaxHN34hEyKTvGol0WGI05RJFNHr+y1Lc+/ZZyxd+qD+OGa5H/b1hkEhzvTNRPeex0upkOmYqyQkcXlsii/wcz/ERGIeeEgI/LhS50VLQ793CgsIPeZ4VRZV0RbQ2vDSwGpkkWO+5h5qcaNHY2MYfSKnVp6K5HQk2QAkdgajeGZjnG2+bnzycxDe71t19hV8fMuW61cn5t8nTRAXpf3SGEBtMWsB7BEvB+ycrRFHm1mzEkIUcdU+zIeXueQ5i7RuFoX+Y0+Yrj9clHcRnXna1tooBbBV5VxXpbNxshi1/Sk6+KD+3lSYzeuPHPc6gU/v6Og6pFR6Om+b1llj1oC1n9Ne50qj6FriqnxOF7BnnFearWnkuIaHHcnnTNn/NS80q5Lsa5+cGv8ZxPsFfjqefX1TnF4V4lTCKw1srpCOO9tw+raHWkfi0XAhKA0gi0LEyXPS8DcyE2UJ1tPE9Jq09/BK4Ykq3TWgzMHA0//waNSPxTuiws/gLFxItT1MPYL6/N4Ou9cJfFZHx1ndgTmSD3dwtJRBk4aER1fI8KM9JKHYV9rEhm//4WjLcVYWNaIEfekwNxpRxj0WiH5otiTmjmvr9U+JcD/BZTPr1t5eTz4z4gWTmP1IxXVxq4aRNiIsHzUUepRy0bCtZxx8vB5LmZyhlFiShMxFiLE1hCuI74/8x/xNb28/RLsE32ABJ5xkOSxEOlTBQm35cljy8qlWQXT1xpXnp8ab1wP3e5vA3oBff1q3lwQ1EFDu0AC0odpRWiENEc/cvYjEKuq3XoLBe7NSZTnmvsZMp1F2cy373OdHRva7/1P73/rMd1b53hVYLnAMxkcPUraPOzkFq1c2DggCuEpQDcpofC+buXWDquXyy4ipNOYltVMeVSg/ThR3AaEXtchVI0LKd5UApDyEWW9xtP7CYqmMHkxxyp7bMfYqgS/s61s2FJrT87QmF7g5EhBsgNxFQ1inCxxF2TA20o2w1g+fXAZqdCTyYEcwjqM447Hx4hzziJDXxsy78Yubhj8P8X6HX4+Pj95Sr35ia+Zt9uXqA89a2KPZcgHSkoBQW8GlPYQpHONoY9oHdsEozHie5TgSy0YrIVIe+EG4lqemF3oLsuypSMjFyU4jyE07C2J/sHzWjn0pfcr+FRdSVpEuy6dLPYzIYeZnQe7ve1chjim0ndOdhYv5f788FUrTXAMQL02wYX1KSRsrLcUmCzumFR3q6ibGpwoC7tom/QV0RGwic5effPlmM72R0v0R71m/+edbkvD/0sDHAclDVKdJbKZz3TYLlZDMDrN37CCD3H1m0yJf2D3B4rq/UjnuqX19C0S8kygX8m5P+pgh1BCZy31WuJzOiJhB9qP4KXE1oNzLMGWa10J7bxK4tLCUnlswgR/b1+HLEYnKu05g7eXSlw2TvLIAsfM8sQjCjJOGcoNHDgVGq1UYEoOVAyzc8nz198fHvwHV/RnJn2vpZ0eq3uYCCCAHPxpOGxA8fsVCbLscvdwA2opEooTK2GhP1WCA5prVdTny+YXOLB46phg9XgQ7iYIfdmQ80KQslqOjr/QNy4SO/pWZ+qUOLNrWLfXSLMhqU4zfEfYagV+wpH9Fb1o7LkpSVBCm4t0lVFpITAVpGFsxC4akgWQ04MhNuaZjpyGAHR2rBpe3I30zGZTM2sD/wq/Gx++2UfstPrBlzW+3ZPn/JEGEU7Q9s7PDYQySwvllWiZspe1gFQbFYk4GPTE4/TZsN9qP4zt/4t4T5IVjWyvHU28nUS6YQkXKxleJa8tnRdn39AvUL/VQdWz4gPD1xu+qHhh7jcBH5f7JlTQfzLBIyDOsMcFGGTlsNXkU6oLENcPGWR3rlRi6LlLmcWgrQzJXxpf5hr5vtib+2u+N1j5L9QMA2XV+/YtbksLmCLSQOT7aq9MC2tJZTtsvZzHKwBVxsXFOqtfI9SN6jLfpXFquT8KsZpKpmUcfZlp36idHg8Z0V/K84haI3Ok0Rg8SuoTM47mxVBFzUKMOn9cweZoV96lnIQrtiXdue+iFda2/NMYZUsPY1NtwCfHaW6caAb8ErCv5aV48VTFFADfFJGrTdHzFz8Y2rqLGgYCPrtt85brUvyLhNV2fYyVaTcbJV1iwHUnFOBKnn7mQkdpCCI6PzUowiTNlm/FOvnBR31Irmhce3VHpLZHAcuSgBnSQP8+KBPPXgw01tlVgP3Lt4u7OJRiREr6gbh7YKwQ+t7+/o7vgP8yHUVgrPsbnRgyCDZDWoDbaEdpAvdKgjZbOcC2GI0e13JFSGcM6v/NNCfLhNJ25Ja/xcckDCldWJ786lgdZAQTh1ZhZW+iJWdYM1iYS1/jANggLjeCKlqSxuq4z4OHNnxm4i0olc2J717yey3VYHJYXFP2gzBmAm9IxT1uKPVgIVkJq0YjjWYUk4I9FZoJs3yHwinp9RYeX98rpCWEhr9QarjWcHTwFcvqRoBUAkgabTBeQ1qm7jRnxqOeRXsYIta3u//6fTPIHRh1I+MzY1p+vrudXFYOC2ESIwD39jgkWYhdLbAnRY23HvZCJCwzKbBz1Gc+bSl6SmWu3rXsMteeLShC0oZeK7GspQ6TM2MEeaE4GRw4uDYk0D6K8UqnsO5fRVpRKJ5XTrJtzK46acuSxptJKEhKutAcuv7Bm4xQnKurnEc2Gs69oGnsdQzuSelDgv2iOQbg+qX3bDA9PSMIDC5PjlcoXZ7yCvBtKmy4zSUtoNZeSQokht3RpQomQSEBlMnozD00KMOzr62zTmmkPzJNsxLzQUgCHk7TAzLVMfrUu9OkIzDD9Gs+dtMDH+RNqfMRgbB9axHndQXRkMc8LcopwlabXNpCbzL9oTIEKde5EuUrE6NTDR+dUquM+NEsRxt+SeuuuSqd/IEkOQPx448YrNyTp1jLsQjuobWAPsQXtpfZwVpMQV0ZWpmaHX5Xl1K1h7OHQshmvEvmZGSy1dCI4bxSDrIQCAp4L9bYwQFezb4DeRpnywdCEuvAZtJkkzbfMzOwbU4gVxvRiEnUk7yKpoWggjpo0OJup0NOZiERHNlEhLWfBUxs3FTZORFYHK1g/MsNJ+MevDk8+5D/U3FO4fHr8T5vy/EquJaQHhbtKAntSk13DK2c8NawzHV3uZntAIfoAfxnMQGcQBL2mt1WlO0aU+e2B755G1wFH5+WWpFIXV4odeamDD12mm6lm8dTWZN8g8F/3dAxW/HSpvn1wtjjeMiS0QbZhgBiWDedmdYTwiJ9rarmVytU2280NqlSfhGciNz+ByrwMsJ8iW1OvXjaN8aoAxorlZGpGV4mim7UnCWLtRB2htvhVTxZz9FNJ4hW8wpHW487lZuwQK9oh2r1Cb4sJtCxAByRbJ/opbxSPcjlnkHpoqSRyHtdn1tQn9o058LLWcmuUxR0y/0XttTG2UdI4hXPZBGkkOoL2JEhg9yFUTr+cqITY7KgQzRnLkm3jaXYdNQ5kpFnhF1UTYLGudtRnpZ1taDMLseVc+6rdnG9WTlhlgHkleWrStN6xMAjn/ZP7FuN3F5GrTgkhYNmNQlBXV0lulIuSRMnGHx7Ug2TbzTPze55yjxM4jIMeEKulcRUBMtZZjkjbsMblMsiFrAjoFQUaApqcj9mPXHi38TK9wCa3VbGFfmCmA//2a+KJ1ZrzgYtf1/LRdfX6xjDQl3+rKfWAph0JnZZZMqkC9NTumkYV6aetxecGDmx8b7GXZVFvMZjvMxElL08W8mSgZbJfOaYSFEi2s/WCX3kBuUaAkZgWheHGjWZy33gWIs+yxQXfL3E+K5feUVHWU1qiLQMoUAhJxZz4IN6NvlR2WpKH+vC1sdjxTZMzJr3xf8fH99nfu+0uXLlt7XjVZL8MCvzJkVJRLCXGtabFji7JwU0tiXgKRQ2dInI6ID887CdHZq5TfBCqvdzSTe0dot1UCoHp5ls/Nd971YvEVk0FREJcATwIZDggwyhi/02r/IGxpwnsB0m2NMJkZ/vFGBpmA2oqbdjceDEABWIIpbHGWJ80XGZMOuL4vpnOUlOr1f+M0IE8/3VIg1Llxmm0necnsYzYRC0koxyVKKENuUGgBFcdUaeWfG2IerQqhlH2CU/pQRDNawQ+u7WrJcjzBbLesR3MA0I6S48gSrjTkZchlk19lsrTK1pT9P0RqlBvR9jTBC5EgRkgyfi+LzZEjAOfVpkuwtIYDStUR1jeELr0tmUMAi6a9ql5ZnpbnN5lRQc8ZlJvbArGkDtyc9CwpjWOs5kQ3A0k8NPl1kjuPHTQJ5yO8C1GbTKk7hjH+IWO0JiFdaS0Rdsy1e/OpuSpFIVcVU/XMXKlCuXGeTYu4nlgjxK4r+/YoOxHRRK00SQecuKIiRsuG2E1pHVKdLaUjcQYI3r4aCJ7ZNuOQYAzwVruT67P8/Uac+Bj62TVVBPQDDZyawz5cGEHOwl5EBZ7yUeJwjixt9hWZfTN2pibvpuNN4sw+HAg3yFaTdRdCMJ2do70GYUcXbUKKIkPuWKzYRbMKjIsx4ifmylEbE5q8/7R7R4l8BELEq/INznJJQhUlDUVcqIBrDk8ajLrovJylIo6I+f6GWSAJtc83GmIefJqzEye1Wuex9PPQYEN09tmppIYAxrtobagieSSJO1LmTAEO2WzQImrumpThtWVhDa9kANunMlV4R2iI/WHOnM/ktvTNt8GWCaJfS/5bAiUR0smUs+sqybz/h+7PUrgQ9LU8/ykxL//J9ncT1nkCEd8w7gWzsbSRtHBB366/Jd3uS4MfZXp6Cskhocr5tgEI5mp7PC/xQ4UbK5Obajn2RR/PebW+mIf9amdZKNEben0tiMS/MI50aGfiajnmzRNQeDqVlV8YHQWvMMjLwtTEFHPCJK15mt16LqQ1AQ7ro/4jLiP4wQkH74zSOf9p+p7lMC9ceynWRZxACZP2RiSbnYEsI1EK6RJDNMVolsdm04j1D8rg4dpkTnzTTMzGsLa1DsYEBuvHvi+/JnEXBsRMv3C5s5WEiV2n/0oYDvaDzbXgcXGMRoZ17IsH52sz+vN9S3GXyp/WIaBRl6HxfOplIlNKsg6MezqpOXIQpNHEBbigedvvq3qzfsy6B4lMJEHqCbPQDzCpTVum+Pli0cg4LVcCpS82DE9d2IQHW1JVLpiC27YyUEBFwuAZJM3qQkPAhRMEGX6LjyYzdoEOyEvSOmukyth3Ed1aGdxmQ721GmHEp4f+mXiEIQza+OZHRL4Yaa3tcsEy/jPUom9kSx3XpkHZFoHEUpfatmsH/0gIvqYv2RO8mzi6pGRYZXuGHuUwNNjmJr7AWYQIB4bJRWX9ohh5TQjEkdabthL29gyrZ6T0UeHm9PlyKEhEDtM/HLjMbYDH50t5UHM/dv5ejlaxZGEdhGbzQm5ePESSCgxEqb83mbjcgv7QjS52c/Wqez+8fiO6ZOKQXIYSatPv2lBUgNkze6kX6k9B6LmdD2D+R//4mzfWMSNmG6Txl7qXqqhprQfIS8airo78soCDi2VEYAb45C0caeOG091jMLGXGU0Zl4yEc6KYUvLHm3TvoQl5XKxLQw8+UsChGVTRqp94aVtJcxY2k78JBg83GTHOPpVTwiHxKRwZoLpLXFph7/oPrq1/bDI1HvrvAQv0wftW6kPN0IcKUH6mr8eEaDAgBMJzJ3Xxsm8R19ij3b22uDubDrLayQlDeRcoShdG5aWiatwDSdZeW2wEeWsjnRiGMQzC5qBBzxOQ62VON7bf6H6kGFFqT1r8UN9qAlhbmIsaxPuhdoagI3U7sSsvhKqQTJJrGc2Pj2YJKa63kzs8KpAV7F0aLvnB3wCR7pJoHnzw+u7/NwXJEbKD8yW6Z37EcIeJfAvtmxJp0w2JQdao1FaYSeQo91FwtGfgauGsJI+dJCSngrcrBgbO4XdpAT22pIknNefRB8IqBS9llLgy9sleYGGlxIJsQXtIwERqf1mg9CRWGtKobkGoCA6mPLx0uzmmRqDD3gd+PiVK3u9PD0pwlyGZ0WSUbpOCkTert/osL/ot5CeZv1BxQk/M8Uov8pGzQt7+nRbT5J8PR/GCWylZy+v0BWPGg9NEJdqdmvoIahvkcHIIOkgl6EEG10YgKNFwQ8idOS8n13d3zE8PXEET/I8vPXAVku6AYOdywFBTISP2pEaNCAdpuEXH3iZRvqDMggCfNbUpnb4XPXjp6eP7TL5UUpfUpH5ar81yhERAiQrywHkygdcP09Rkm82pIkZjmo7nG/PxZ4mcJpFwW011ppGsUJpDVrBdugejbEK1JFf1sLVkYHxWk2VWV0LdojMhbGVjVdq85NeiTjAsbK7uz3yzWkm5QyY9uHVmFmL6gIZfnug0z4EY+UDu9khQ8IOlAjf4In9yGSVyjc15v5xpBc8utWkPfzjSHtNTA8IQorQclze2rsKqRfqWAhB4Hp95DubR3bqZ2B7msAG54S1dWOmef9bbmLQbKiwkA7tkEbZlknjRAY/XekERnHSTxnDyAPpNV51GMc3DRdy09YbVYaQ5IDHeVFbd0+hdGic4NwDO+hBDPvAiPLciTUm5bSaLMqwyYd2E5cy6BENW4pX1h6jODjao+gBbyrw1xoDQXBCGUdKQjrJPMaVg/zlAKKIverqZfuPEvYlyFHAnKfkRT++qWo2aIL5YY8TOEu9kTTNJlBNCdumiU/aMxtSQkPmGi1x8MpRClA6G4cc2XjxY7GBgyPwvWI5CA8VhQMcaX3yHCxYWxMwYfZDW8Fa9josr8fmOWjFF8nI0JjidM2rBLFc1hSyyvoCaeEScvrHFgUFs7VWH79iw4YHfLDmFZ3BiYUsfjjfRk0izoXUB9nOnfOKb64alBiM0ZelUpk/RNipJwn3OIHvmZ6ewcp0Wo60e1WcYR6JGuBooF4rAZCGHcQphXQU5cyEm5UhkYYwZ8NRXDDJ8bvjj0r2dRzeUn5sh5d4ie1Bjq5YA+nNB2wcS3FGMm2YXXZyywPTnYem2yuYTq/Iu2byokDq8zFG9o9aluuV3PCvtn2/ePkV9fqdUsB9w1vUGp5SifJFfPOlLAxtPzEnWWCzUjyQ+JFodjrjbU/CX8SovRHutePjO/1f1XucwL/bunVdbMLVsJCVSCtgXmmFQJos7UKjrCut0x3g4t0ND9F0Mbx8iCwDE8FWbak59uRK527918l9Dae2t6/s9b1T+XAUL09xwJXnTAIjB3EFRqwUyqbml8xGvzRyTxhee6vv/fQWL7hiVVj59ahfXhflRdPBS5Q48SO5EIluhtGafywznWRmOAtuhOh+f9pzdvtgV6ufnsmXAfPdwpJJA5zqcXTXA4MdS5d1psu93KmDPEI9tplg0xWbRnb6b8/2OIFhgS1V39zGP5fm3+zLEcp2qtduQlk0Rv00pMj5kQjIKJfTHGXceHqUSLE8bVdPYlMJzZKe0i69lG6/wTM7O88d9LwlU/IPTzh5w26B55uSH4JtRbM+La75Yy37+pXGvOB701PnXLJ63dkXrd149vPXrXv8M1fdefaXRkbOuSoPXrTaa722gtFY3rVmbcm/5A0D30x63tbr4q0P+C+mZ3SlCxeE3qEB70FgFJEBxvYV/XqJkx8AOxlo4JWDTQgsNGesqab+Pb81MQ+YncIeJzCQjeXmlmrmJbS1nEHkaLRFIzzXLxvapEcoAwTjkYbDM+WMhxG4UVe1Uow4WMVFnukvyMuZD8jrwUs7TGd3nl3i41TEH56HOJDbPD52XszWpsGV18f5K746Gp/+2g1rn/PeNWv+80vDw9dMGsOnydy13Jn/nhq96bUb7vmP71WnnnmHCS8LMN/FIgwDDGbAsKkfBGZiylv9p+Ftf7Jp7hOtaXp6Wx4u1tclaN9IT7KfhLzSPbLNRUOGuvNHqTU/MKtqNZa107+k2RsENmvGZ65JTDBKvnEKwOUDFxGuIXJEojESRwHlYKle+2W8XrVwR7gcBNDj5uR8HE+O/KRuOor+o16ysPtE5nOg4ZJo0TMXm+C4iaxuIgwIaeSbTZn/+9uq3sXvWLv6KW/ZtPZj36tu4NNcD3jzgfjili13/jDZ9po1XvQrExZAhkzeaI/R0NyTxT+4mQ+83Q/4P9cDhfJjMF0px+gEPUNq//HsKP1LTlsiS2/rF/GUodfS3JQy30znAZaWyf8w353FXiHwrXlw62SWrqVxZLRkA4SZ9EuLcdDySX2JtaS0rRW/kl1Oc/TMOrIT48HD6CoWEwv8QveRUfvzGH0g4diWloUrI/OiNv5heRhgyhRuu7UWfuyjI5PPeNWWe75wtzGbrOq88bVN4/dgfvcvw5k3VoIVCxgN12Vm1T3e1AP+k+kFi7uPbsuSR3IE5cM7AnSAJuD0QTx6emz4XSy98MODZpjN9Xo87GW79EPcvULgy6c2bZ1MvV/yfgtLZDNIZXdJjEI5chFUTmtDGabPHbGE4/ysUewOYYpingbTuukJvWe9oLvvFMYeKHhGW8tzB0LvpGk/zfia1Vvq6bNevXHNa35THX1QrxH4v8mRX8Ze8PsiyMshd10UfOXzI5P8cez9wTsyLJ3e5nlDccYUiUw92J8kFC/FyWBk+4h9TZl2mwr5Y1H5kQKmfONJeu331kzt9BUIYq8QGMhGsuCnE4k340tD0QghK0dNbEJCHUklLDFoHHb6EIjaQua8Nh0ykXjKKSPJdVDP5J92Fgb5gpPayq+D6ICYC/9tT8+hywttL5iqh1vvnjFv/veJifNfO7rxh4ja6XnjvXHd5OSWsTy/tgpTbapnd98wPv5liMW094WLhxYsGsr8p3WBhzGmCvzVnJ412Q90OSqzL1XgetT1F8Oc3/ASXhUjVz30rrjOTG6BaKextwhsflWtXznh+TfxvbYkLH96zUbp/BZNIjnlKPXh58N1ekdJblaQoPRDRdLIRj8fYp+dFwvgJtCL61UzZLynvGtg6f+zMfs12sLuQ2ZM6fc3TNbOv2TThg/w34ts1P3ivO7uxf9yxBGnvv2IQ7geeMADeaSWrV/nhcmaNP3if4+OPtDoaw5Pi49qC/3jee1XSMoniaR/SE39kFnsTX6FsqJHP4EAiFtEP0+mWf3O6swu//3ZXiMwphGbh7P81zlWzGyA/MxImyig6/wKxKldLMQsgsZNEWwczV1aklruN8Gg03lqivl0uCLy3vzShQt3+T/P9hXcXs9++/HVW1/xxqlNO/yn0ecN9Bz2r8sG3/B37e1fOqY+/T+PSOPLPrh4yfk2+j4xGkab7i6UvnRbvf5FBGnK+8TKbtM+UMif0umllRl0ggw4jkYyCHGo0SkDvzowMU6+ullRCawOsuLdN43nv1PJzgOT0r2HQwulqf6w9LSyl5Ywa7IfNhKGYKOkddpSCdLv5D4NBQcyBsVoTKeJGIFgICM6pcwzxtm1y/iVSlQ5usOrXPWn6sROL3L2FdwxM1LbZKbu96oAcbwxvW/uW3LJaaXSu5Z75rn9Xn1FKYvbBr2wI/YKxa8dsvwbZsOG+yTnUNi1Zm1750/+e91dD/hagld2LTzxSD98S4cBgTMQlX0EyB4dxD6THrAdqn2IjV9eCGY8HciiIDB/rtZu+ea24Y9j/rDDqyb3hb02AhOfHN1y9ZYs/GUhiNAYjpxqS22yLuT0SbTZDyHzKb2pLvHU0195MN5tHDYYoX4O31ka4hRVN4u9/MTTOgufeF5365EaeeDh5X19Z7582cDnjyj5Hx7K4hPDLA7G09SM4VQ3HddM2csHT4sLmLbeN74xetf4t2/5/Q5/DbE09J/U62c9MzjD8SWqQlQxu7M7v67nLJS/ZK30Gy+zRfBPhEVzjzE/wvxhfn+MfB/YqwQG6neama+Pow387182Uu/IcNOwNF5arybQua0ahDRXa3BTmdiPHvIZzJbTk5zadKHAh3xq6ZRZlsWPPL3Y9dnn9PYeWHfpOjq6Pji45D2PL7Z87aggOq/d1CN5xRYan2GZn+WB4c+0a3kaltdufVC/Vnl+X9dRXSa4IIKdY963lv5QiK8R1J7izvJ7uz5lV4XoqC1JbWK8pfxjEe4i9jaBzffrG76zwYTXFOWHE1ywsalsGFhNL2skHt6YICex4zViIa2Nl2idUjDQmBMDclPE+uVgQDz/92w6qZllnn/auYXyV162cMGTVWP/xnN6Oh7+ud6Orzyy6L15aV7vzauJqYK4ellCzkewRWACP8J6IB++buRB/eWCd0ap9YKlfrCsyi6RQUJLUdsjDIH2p4ZFxoEGgwjjOFi5n41EOAtPpfmvP3/33Q/qVWB7ncC3DpuJ26vVT06g1Z7Pu29ooNwkR5gGgF8vlzFME5GIbLw1Fg2BgE4g1BjMQ/LRoAzQ6rJ5AdIEpgbhlJkxC4P0yJNLLZ9+86JFr0BkWRT3P7S/b/HQK5/d0fn9E9P83CCpmnGcb6poN886tJc7q/E07+OTJeFdI2Zkl1/6clFr4fBOk76wgKlDxmcwfNgbcrd+0cNFy5S+QV3k+W8K2E9CZJ3+FdAnU3VMIZLa7zfobe5dxl4nMPGlLZu+tTbJroowMpCN5JscuWg1XSErGiovyKBRSE6GGS/G4Kgrl8uhgzgZlWfTCaGZJ8OMR8iHMafhH86qZoGp9Z1UiP75Y0PLv3Vp7+A5UNtv8ITW1iP+c8nyL5xVCv55MIn7JhPMcXE65x+jZPL7ZLac7aa9QBbsxtD2P9emHtRId2rrwpcuD0zfGMZ3PrguaxXpE7Wz9BM7Ej6xOCIoZ79QrnNlbpj/8ukz3990y3T9V1R5MNirVyEcZjAle1ipPNVrgidV/DSoy3MRaKg8nKpzBKW1goYgWcUYKqJAIN0lUSS1iGZBZXvKEh0YnqIY41QFXdwb+Cs7CuHfPLKrd9nhhVLtzqmJLajbLi8o9jDCd69c+dSzSsVPHh3Ej47TGua5eqCmsB/br6MRW0gyi8XkT2+2+oXJq2Ym3/uHanWX/vTxOQs7j/mrQvlDHX7WwulD5mtJMq2j6zbuWPwcgXpd3+jltSD0zcYg+OMtLW0fvnpkhO+B2GU8JAQmxqen7jms3H7Ugsg/Ms1iO26QoLSAtB07hOixhtAjXG0kEGPROEjHo1tkPBT08o4bvZmvGhsjMQ4Qvj2mjhGkltVNR56Ve738ET2hecop5ZbTji+3dC3t7Bi/YWKCht0nyPysga6hS7t63nac771reZ4MTsexqaMNPMj11O1OpWw3HbYbG+xX9gtmXd278QdbN75/za61x39hT8+HTgiD06aSRAZRAbtFdyyODnaIFI9CrgWjHozXM6wu3qYw/72hnn/pXffccznUXI67hDnF7X28dEH/Ix5eLn5toaktnwaJZ8cQVy3epqRfO2a7llpiii6TOcsiiAFJwLTsRDE0wQMCajxIKONzrEID/pwbBRQwpRn3IjOSebdB+Idt9fj3a2v1m6th8c6Zsj/8ldWr+Q/qO0OC8OFdXS3nBEGlKygtGC0VhrYWu4obqsH131199d1W54FQeOfi3icc4RdfPuR5jynj5D2TYUM95Z9mcSZpHNRsN9rGjX65QxlkpsOUzJ+m00+8cOu6Xboj+eq+xWeeWyle3m2mgxmxF/KFEWlyHSRsubQpym0MJJDINXsblH5AXAmLyg1etOkq33/m2++++0FPIWzzHzr8Y9/QGw+PzPsK6YxXg1VoGrd4c9ah0fhxnUVQhUGqSOdZvxgOPqbSOLJZMp6joy47gWVJvpibMV0Io5f9EG5kJuLEZGFhq1cIN26pz0yOTFdvDKPCzZWO1s3dpdJY7kcpL1cFaZqHOP4Khcz3asYbS6qVqampAS/NlncUw+P7y4XuqSyIt0TRrX+qZVfcGXR/7/K7fveAD6+8uK9j2dGlzpetyPMXLk2TzirIOy0HKtslr9BDgIcoD0Ft2yxU5oeZqdaCmWvG4/PfNr31exq3U2j590NWfPuv0uxxoxkmV8JQbMicswgSmWDZUr6thDqz/SZVRT8UsN4p+EVzR1D4+kcnJ/7uF1u2TIrqg4At8qHDOZXKonPbu75wSOA9ftJUYRS+j4DVQqtpMELtpLV1foK2QVgITJciK9O0TlnJL6OBiN0YTC+EjUSqz5dlh5g78rWlfHEIXV754K9K0mKU+76feAFoixzl9UhI61Mh8LwwyUH9PIw8L8gSz0xl6XDV9345kntXjGTxd/9h/fq1LE0Kum/47+/vf9rSqPDy/iB/dBdW/TVMGWpgDF9Ty6TSVtapkYt65KBlXWTxm5lK6Jl76uFPP7x+6ml/MKPzfuu5w3sWL37xqcXCp1oSzLflACdQMPcNg2OD6wYCmaphY9hqWrtjOgPFiSxMb8j917903ZqPSvSDhJbxEOMlHQsee0Jr+T/68/oKGop/4KfEghEsEWkDNYzrLgX19HKZk3PPNCAUdW2cBCxRaWjRaWTU8DBayqQKNz72xzK4KOLzzKQG59Dy1yrMC9MPITpkUhRG78lals6E0bUjfn7FaJZd9g9r196EGE4/HhAXLV267K+i6O8Gk/hlfVnWneQxFpyZ/ltQzhJZU51Uscaz1efzYDyjcHTm6JvLb+P4s87rq/XXv3bz5n9SxfnjWa3dR57f1fa9lX68YhvfuIO2uakZ28nbwnK5k2Fs2g86bZAfeNKG1KM9MRjQNBXU6a7M3HFZNXnG57dsuV4SP0iw7H0Cb+rpedFRkf+Rdj9vmYJx+JMZXh6T64xUIJlZ3bm9J7WHR66jEXo1Q4gqchKfVtSg4zKTyo6qVJN4kUKMUhBmkGJulHL8IX1dYoyHMlIXQv69LciVBOmYSe8Y8/2fjlTT396WzPz6C+Pj90jyHaP8wcX9z1xeKr5wQZo+sj3PvBik4fMifGqPZbraybMHqHDjbZ9iH3ykrRDxQOJVlrBg1ibFG3+ybeJpn57YersknycWgWtvWzT4qaOK3vO8rIbjg62VotQedNVoDAk51ac6DOhIDGvSj/7hI1w4c5kb4+w/nr9+/csRfFBXHxykPvsCjsV86zn9A28d8r3XFkw95HOiATsJrOPLkllTGkkenIbx2F3sKjUc/GQnRiIxNJWloxuxCKt/LkSPQFQjJRZzzF9vjDBfjrhQsar8M8UAsgB6eRaamcQbnvTzX09U0x+uKng///iGDbzeOu+F3isGBx9xghe+aiDIntKbJ5UEi7S6EAb5y80CFq51tYcnYNstJIZfSIxYqmKrYNpR9Svmhtj/+1dtWvUBaIr6fPGRgeWXHuOnHyl5tQL/sEV+K4d2cyEtJbE+9LNcN9o2ioBfwixUbUcUvdBszr3xa5Lkon/YsOF/VfrgYbtl38Cp7YPdzyhkH10SZs+vhylW0qkJ0Zkkpx7wtAY7kYSGeYTIBEcmEth2OJtFC4u+phC41oLoNDIpK0A+jOJIwlsBnCZgdgsfciOB8Skh/8gPzAzc8Swbq/rhDVOJuXx8Jv/Z5aNr/nS14att548Lli/vOznyXrA8Tl86lOdLeNrFzAN10gNJ22AvklFE9gAcaRkne2sDAerLmlK5NQjM7Xl07Y/HZ575xW1bHui9Dn+BVy9efOZjo/Czvaa2vJZgZZrzCT8SmOWpjlgLZdOnbLZyurY+rAm9fGiL74duwcrgrjT46evGhi+4Y3LXHl6/L9ii9x08uVQaemRn7weWBumzPXRqjI7RP8nhCRtAp8oiRciK6rND4ej8j2CnasPk2qNg+2a6+Ro7W9KQwJQxT1g+RHkl5MiX2+VhiHloZIbjdEvd938y7Zlr75oYv+bPpvOPvxhfNe8/I5mDtg8sW/bsQz3vxQvy5MQKzqQYdNFO/WEqW8V66byeZwI42OQdC0Ike3aQWLcHdTHtSpA+Almqxk9uiM3LX79x/aegMG+cV2g79Nk9HV86tJicMpnGJkxkxi9nJbUVS8cHVaPr7KzQANcHal+Vcq7M373FnpddNxm/99LhLW/VmN2D2fL3ITxiYGDBM/3gUytz84w4mzJVnrJTkAkjC7tLD37tPIJePfApsw4tCEPylqqoAlyI0cv3U0gH8GDg6IZwgBV7exDJXG0qBgmC4uYp3x9ZPTl5dxZFX9wQV6//7MgI3xNmc9tpFN60pP/Jx/uVl/d72aM6McOt1+qyQOP8mvUkEedUXfx0pZm2kfQSbpzmXmboEMS8nh2UzJ214Mdf37jqwh8aszMjXctHly779PFe/NxCXDVVThtwxmFdZDTVmsnHfrWCDqyo1aWHdOeP/VnRCIPAutRsuCydfOIXNozv1Pt/dwSpx76I4/v7e5/lZf86FHoX4CRm0pTPWOFknoHINCAsq32qIwNPoWpoksFaVmxKCboYnctJAdfyIYwdwrC+H/JfIUGlwGytJRh5C1eXW6Lr/zg1ec//jo1968Za7VYUZDPbZQRvGRo6a6XvX7o0yJ/Uh8VZHaPbFLLlX+PyYGL9SUj+XlCnRWyYVB7Qg04OUMpIYjkQ8aELEVvG3NpAui15y8bf1vznfmD4rp8y9TxR+ODKZa862mTv6KzVSnUcTamMsqwVXFumkFcEtmoOrBYcIa+LgIDTMK5j/KBibprJvvz3m9a8eNM8rsbsDLarx76GQTNYftHi8BWLvfobW03SlfHFdCk6jVOIhjGlK4XMcsmLMvQq75FnOPVx4hFg/sUV/STmdMUgGA790sREZqqb4tr6KPB/3Voq/OmmbduGPzE8zMtdu2V+drYx3Y9ZsfTUIeO/qD9Lz+nDNLqGka2ekni+3ilDj7MljW6wxBRWArpXlxpKYn6lxYwCkA/mGWFAEhdqd2WFv3/hurt36hrrhwYGXnBE6H28z+QV+YscbB7WH2JUFMPq6BoDQdaRckQIYekVhzUi0VUg0zFUuBhlZiQpjP68ml7w/i0bHtSzv/cFZ4V9Gi/t7Dvv0Jbo1ZgznlnC2EAjsrN504MNoLE4VshNBb3gT+slkyavxp65IzTBmlrurxpJzJ2TJr0xTc3a39bN1t9PrOfC6wF/prOzeFpb26End/WcM+Rn5/eY/OQO9KGfxSZGofLyFaunl6EA4QK7n1AZaez0RC469MALvxAI6QM4fDu7XB3AYutuE33jaxOrX/LjbWbef/b4nv7+p50QBf+60OSLp5E53/ErRcnijIRkgOXRRZiFsRJSJsKU2/oIJD3DdH0cWOiAvPjdC1ff8xzEPug7b/eGLXXfx9nt7d0n+YUL28uFv+4I/YVRFpdAXJxFCzMYXeOZLK3FSbIx9v2N03xqMstA1sK6NUmy6ltjG/lTmd1uPAvvqT09/ccW249cHGRP6PayJ3b6/soF6MB6VsdcUjuXRHCvMHVglIBkgEIjDJDS7lYtE8vVB+kt7pAfTvNC4KBuQkyF1tfDP/6qGr/g38Y2P+DroObi7X0DTziuEHxsmUmXTWDE5RUYOcRQX5bMOsjUwbGEQoZtQA9CbtBUR4K8dKZnPs9Mm7D6m8Rc8tYNa/lT/d0Orcv+hMHB8hnDwwu6grSNV1u3BcG2jVE0Y4rF+s1bHjNjzDd4yWKP49mLFvWsTNPjFvmlxy8sBKe05NkJvb7fUcyrpoapTpVTHSyC3NiqHax+1+kOwk2MbPIPmZYtTKcfhCGWfCQKBOIBkWFdgHkSH47ZmIa3X5lmL/mnTevmPe99c3//X59QCD825OWH8Bcr7uXjSl2tE2UezmhyEUIrIfXTGrImMokAWDetP+O48WmNSlAw98Th77+SDZ/3zY2779LZXLi6NLFj+I8tlxc9asHCYwYD/4ROk5/ZnWfHFfN8YSuGHA8LsxrMmWBk5Dibchhip4IJ2v+goO1dOe3C40ZVcURJdiKnCq9MSCQ2zufhATF8XkkUcpUg2pQVNvy5lr/6raPrv8a088FrBgbOOjkKP7nMJIdVY71VzQUky2G5MkUDpO7kqFTc1Q4giakIbZE1dqC0ZJPJ1GEa05o/1Kqve+Pm4Z2+lT1fNOrUxF+gdPGy/r6HF9o7to2OPrK3rXJqt+8PBdX6MV1h0NMKmnr8DypYkNdHeMFe3nrOC8kM67DFPrZQcijgBykoEbIIazSGYJxeWSBBNCIBk/jEQ5Ri2Ye5QzvctanZ9vs0u/QDw5v/S5TmgdcsXHjWyaXSx5f66REzOOj4WlSpDw9CXjojaSniQpl+SUWgJgi4qtpUjXjWWdIJ2VNTwuh7W+r98bK1a558mTG79N6z+cCV34R5ZnBueNmJJ/f0HbGiXG6dqI2f0Bn4pywqlToLSbawAELLdc00wShLssILVy7ScURCDlx6UUK4VbuQAJHS1Ri2cLa2GgjKMMZIxqlM8mA68TN3ulyw4qTMS1IY3TrCyGxO/M1/nKy+8x+3DX9CEs4D71q27OyVJv/4siw5tJbWsWDjJUkciCyQ9eUUAPXQ5y0QtGG9qcIa2T11eCZAyEnlbEJAt4TwdFjIf11LL/3H9ev/TSP2DKzZDhq0PmloqP3Y1qilVM27xqe2HdoRBisXlYqD7SbqSuPqscUsX94ZFcIWzGO9TC8l8Qozf8EhnUSLcfS0c1Y3Qsp53XUpvtLliGK3qobGuX4WPfWAIIybAyTgm4uoy3xSlOUnfMQzNX6xaLbk4W1X1auv/dCmTfN9xjd499Cy5z7MMx9Y5NX7J3nLGmXygSnC1Q+UVZ8lsFYWfrYVflKWX0p5x40p9JKa2oY+3mrCgW/+nIdXvmN07Am3TEzs1D9v7ixYhwMQDyscUrqr71HltqGlC7oHerJ8MIhrh1Ty+kAlyBcXTNDbYvxOjGblME1LIW86odN42idpMcgZ/vdEimGWnSxnWZiKHaSdTF0ooNPkeickGoc9Ox/gQms2xpqZRJVe1zxcnGhhaGYdeEiQFDLFQARH95S3tjM+jxGaWxJz8+/q9Rf/++iWXyPZjtFrWj9cWPT6wzz/1Qt80zadx6aOkZfvdpDnPWx9CakR6waPOzBZh0abGMaORKbIclfqSz/bUMTCshaUzVUztUvetGnTZyXhHoTWbP9F4W86+xctK5b6F2bxYb1+eFhbmPQXwnBJxfMWgXzdOE13lr2spQU9wZsbPAVncjMBTSc5ISNB5eQ/h3RcNHGhxFOlEI+lEZCRZHKaZZAkoBk1O3ElRpmqAZKcTADpNR/tcAHzgd/JmTddqRdcLooKSFf3InN3kn/3N1sn3/aFeJz/5rNDnNnZufSCrtZ3LEmz57Xmic9/0OaTfVo/PWBmwZJ50GgNWLYCbaVcqzXbPnpFcdYe/EekrigyN6XlK1+x5u5zRnbyAaddgavL/oLyc/v7l68sFE4c8srHtAbx4V4cP6zge4OdflAuY5QK8jpGUd53g73BEl6YJx04OmD1gxZzMaQ0ZY/oy5ml60Sm6bAXjx0phWSawp1eXXp+hOSI54HAUz6JzHj6dXrAJZn1a0LNnmULkyWEj60FlOQhdqRqzwtmkylM3xUnH/vM5rUfvJn/oT4PcLF2YtF/75LAP9lPMzNliSkjJcugHwKpAj/b1cvqUAEQAlOOTebtaIyO3Jw/M463nnnZzJiprFz91Uz63HdvWfctpt3T0Bruw3jW0NAhTyx0LxmtDz+lPwrO6fWjDi+N+zvBEt5nTzAv5KKKf3TI/xqTF8hxZCVxbW9wDKH5labwcb5qF1kC6Rnos+eQhvquk7UjlaASibAajWQkLeETJohIAb+mY0CFqom00JVipK4iRJytG1TlTbuoSwFOEoRmdRbccvNk8p4Pj22c75WG0rsGBv7fkUX/jYN53FONU5ky8Dyhz10o7usRD9ZBGzLrcP7Limkr4KVcrpWpVSlgvXnTohgUzLUzyZcu3bT+IsYwek/D1WufwtmlrqHzetqeclixeMJkbfpJS0rFBW2cmyY1dAYfPcSIxmEOnczfRXCRI79cAHg5i61yD/TQ0TtGCnm2WD6UWTIKo7Dxa8koGvRDA0EqyZ6QNIiTO2WSlh1sO9mmpUymFxByIiJTD00o8TKPxMHGjudUhbeZOb3hz5MSPzDb8mhibWq+cvnk6Ee/MzFxK1PuCM/u6Tn0tNaOd670kwu6krqpwj4x64MjRS9zSeVQBXX1Uh8F6ogY7Zm9BIiawsvb1Dza9ODjgQYd6rMt1nbtmOLcUws3XDFZf8J/TG/4o2aw52Fr+tDj9I6OrnOLlUf3hdnzBiqFEztTs7wX1avmNTODOWsCw3FeKqddUIJmV/PPEocbHbGu1dDRkR2hxpYgRz64ogZIltTBR7zUhUs/YUvQvK3r4lRma+HK4gd+uTwlcjgsE8j59hyIGcWVPJ85loMNp2D+P9uwKcbrvdLP75mZ+fj7h9d/R1PtEME7lyx56mF5/s6lvndknsFmOJD12QtbB9mzYNqE5aNCrCMDooO9ikRbq65xbJvaSEUikSQ48HBsluGf9orxjZPJ614/suFfGbO3wGo9pLikr2P5SX7liX2F4AntQf4YkDby0tTU0AE1WhE15AjKUyCtRuNxT4hNRcfKKOY2p1U6+lLHRtNF3o7YCk2g+VIX+UmUxssVB0Cro3WwAd2oxs2OXE5P/UoYPWZSvaqB8ZczHb6HPvJCzNsDM4kmjhjv2lWJ/7k3bpz6spnnr4hf3Nt73LGV0qWDnnfB4rTeNo2F1Iyc3FEAvtu1gwLx0+WoDB8rJ1IEUFdZ2EkiiZS4e6dEQ8Uvz0GRwF7R3JEE3/hQfebim3fDT+V3Bq6Gex3PKHYsP6u//SmLovD5vWl2fCcMX89juRWb8PIrTKQPoGOjTcWYMDPtbG3bsLVGMZZZC0QkejxFk7Cz8TqKK99ILDcyzyZHQFSsPgP0ikzhgo3pMSCO5M16Mk/b8YhIMG9kt3tpJK484BkEZiz385nMu2Zjav7nZ7X0v781tnFer396Urk8cG5Xz5N7A/9V/WF+mI8pA69Vcx3AKRUvkelR48jHVsy1EOFC0JDTgurK6Ip0c3XFPgSE4kU/hTgAy5jzrMoLt105Xr/ooxObrxSdvQhXrb0GmSr0dD1xmclftiw3p3TDyjWskvlAif6hixpZbGg/SmChkYyeQkDe+uRHFTUNmWLDKkQADpKgAxhxb8ztJPioL0C+czqQriNkA/QywslsWS4RzxgSY+skUwrMI/lAfRbkZioN65NpcM26LPvaz8e2fve7tdrdknAHOL61tfeCUtuTlhT8ixaE+aM6kDmvMLB++pwxXWsrqRLL1YA+LISvnCmwgeSsrtZUKqnxFBIUW4iX6weZf+FghFPGXH0sNzM3ZvGr3rhh679TZW9jThX3PN40OPiIowveGxf5wV8vyPOKV8eoi67mJSNZHMBwugq3CSgAGmTiDtYVsdWZNb5VR1AkDMPDjRJduoFYOFA0DcXWpTJ1xZUutxkgjvNu0cFGdRFj59IS8LLTdZ6N/FGolCgV4OIHxMU0JPNDM5Hn48N5ds1GE337hun0218eWTe/5wT6+lreHpbOGfTSi4eMf1aXn5aqOIXXpAz5NjZCqmflAvFoaDaOB6VIuLOw7WcsbODOIkputg9nRszXA7QnyiJzZ5x95nPx+tf8dtg8mHcP7zLm1nxPovzJwaXP7i/6r1/iJUcUMEeoJTjdIYKjhdjGGpS8gaMCVE/2amUxnl7WEdOLKzGIlyutQhzRtF+kRz4Nqc1cw5aY9NLDeki8r+XJSKNREi2K8Is+JKLDsMZyRGIc57a8PMarDLziXJT/HfbNRGbWjhn/ZyNe+M3fDG/+/WXT0xskwx1gSYfpuqht0cnLgvC5XXn+xF6Td7Lm01mCA5/PBEuFUCUWzBRqQ6mV2I1hVk6rTGj78EXd9QaEypmBNo3xVICt7GitOpgvMcpPTMGLzNo4v/qX27b97WcnH/A/5fYobJP2HJ7Z1bXk8W2dbzrUZM/v8JKWBJbga/9JD/Y9qdioBklEV2wH44l4toqMYz+pMWWHWAhENidsoRLk6ToMpQrfrA6TsLPkIGpIXWeR6Axyz3i66ickBdNjJ4sy6VxeYchBWsb6Zior5OOpd+Oob759d5z+4GdBfv0fNmyYlgx2gIe3Luo5rzM4Z8Ak5y/089O7TdDNw1T+mwKLPvf8rhzP0Je6Sm0YshJXXTZIGgs/NdAmWdwybHXcpUZJz3gJ6Z5pmQ13XM8WcCYZToPVf6xNv+S9W7f+QHQeItga7hmc3zd49JOK0YcO8bNzSxgx4jg1CTo3Rakcn/Q5An5sNeAIEZ21KLBReuUAUwyGuTEa2+yTUpLIyjSRzPBEVxNQQ2JcWKLR6XJh3kXOEljAziTBkcZKUG9mgfqgTjIhkXQJ5oR8YbdnNqf5zNYg+NWW1Hxl1Uj9t5+uz/vNOJU3HLr86AXV7HFDvvc37Ul8bHeet/F27XRoTA3l0GYhy2dlEOaIz4o5M+g0F/V1bcGHZwMm0A+kLg0TaWM0zEjqWPu59LQRfXyBdgtym8iL1Rsz741v2rB6r14yuy+4mu52vH5B/0l/1VL61yEvO83ksbwd3Vfm0hTQgFFoO3zEojCwjIZytlNrSph+GJgVZSoZLUWXB4CGqSIb9Rkn2iKwHawK9FImQYm3juswOKqJvTJAZIyWkNSPSilID+qCLRHqwV9FTGJBszHNV81k5gd/Gpv40ffLhZ/eMTKPV/q/3fh/87Huw0/vaj2rL87P6vSz01uzvKfIwy9PjJ9wcRuYGFMRVsndqGFrpIoabFRX665+gmEhIBuhDbdSpoPM5qHQTESVxpaA2p0xBcyNMrTz1jj8t/duSF+3wczvbLInoTXezeB/FD+x0vLJw/z4xFo+Y2a4gEHHy+JGSiQxsbfE0lM8/OKoadXE3Bhiolkyiob4Z/WcjoRgfe0w+Ypf85UQNuuDTIvWepEEMtJK0kZijDnQs0nJH9ZBRmXMA2eC0uhwZq4eS+Iv/qE69esvje74f4v7jFn48sFDl0XZzKP6i+bsntQ/MkyToQ7kn6Y62iagTcA3sJM0rB/bhni6MtiyTfywPgQjGaGVxoc+xtsw9PWMxwibiI0GRMPmrQKUi41pOHonqAOz78oK5lYv+PnXq9PP+dHWrfOaw+9p2BrvPrxg4cIV55Za/+vwMDutlswY9Iec9mkzMVCjRBW6EZRiMatYkw6ND6/4NRHvWKlPO4NonMJlmIAMX/ktlwhV2zmMYyqN04AmZc0kBn6UIVce0IlgK19IJ0D+UhcOTfDUMCpeVa0n18XBu76zrf0Dxtxxfy+r845uaVn4iErh0OXl0sMWetGJbSY6qT3NjugxaUvo1U1dnufwZVHGqzL8UR+bwpmNXAsHgfgDTkdggrUVNNoikRohB5fqipmsrRjWNrB1TOpa3UimbUcbZQRmhCA35aBg1sfRmp9PTp//mYfgeu/9oVHF3YGzTNuC5y/p/dyJQfqkalIzPL9wlUxbyJxRLOWI6YpGgNZDVWhWkbID6INcnjeAVzpD0ouqAhnP7TdubjrbUGx0sEZI1wlBVc5Oo47Ixc+dXnSTOlOPIoGmYbCOqcMw5hFhUFgLnt9ZzZI19SDfFvl+1c+9JMj8QpInSwp5vrzsh30lz3SUsrStUw4R39S4JgBxaRuZ1wN6hw7TE9RVnnATaN1cyJ0tdDenag0PdRBAtK4PRMAdwsyLPu6hIAf6bDlsurQbH77Qj1M92pd/iDYclWZ+X8te+JE99OviXYVaYffA/9ji5f94UhS8tZhOY7WsrweVLw0jxCBhbIc4Y1piyY6dwhqJDPFz7O+ISjX6GzoiZNCSDQrqqp4UK4lQKjsLMndnTiDx6szKOF2BBJtbnVNGH6cx3Dgi8umuAo4Y3pzggZoGrLPqyYGUKBn4NnUSldStQ067kEyUcYHGgm0pUg8GJMw20rHxDIpIIkWim8SrsViethl+l8gB4e2DtAnSOhn8kh29sk8x783NlF/Or46TN79nw4b3i94+BNZyt+DdA31PPDkofWGBn3VNYHShOYWcgNhFvHqy1i/MB2HDnlSgIr2U2ggSX69xIoVG23wZUGIImNx6VU/zny1bIVnZ5A059W1AokB0ks2GbFuwo4swP/L+YsaDqRIlqiwTNeKCizJbucZZBK7OsdkWoY8eTMK9ORWSSqtXZKyflamYewoJ6+dXItXDjyO1lA8whWhLXvDZOohQ4GyMfspSU8bi1EQt5vok+ZdXr137ekTs1pfA7A5oCx8kLjAtfSu84tv7wriLbzXUQ5/drEZrgDZjh8GrV4JtPGRCDBqV8RDSpiQRRQwJaWlwEWgeskHWcOHhyC6LRUmn+UiH2rxlYwILiSepxEOwU3mgzeYpCfDVgwn1xsZ/WpV/W0UEP2wy564yDRAVyvj4DstQM1OHG0uglNjuTAQmiw78uiGCdRBNbbNrmOrT1fKdDjdJBzmJK34CCtThoowura9RjNCNJVDOH4/yFyyJVzQ3xObjIO/fQ7zPkZfYLQQ+tbft6Su8/OEzWLG5VboYDwaRTXqFXxqIYerYjmMGkNFHNULneRg/5JSvnUobu2vBVGfuzE8z0zx1o1yoz5zkK71Cj8uHIe4Eqs/yVIS9jdP8KbcfyiHiFMIRjK924qbktY8wIl6rRh1sJD7zt22RaQjzpw4+VGb5DEmQiWUvNdDWyIgP2HjVp+vyIBDQpJBoPONExINK5Git2GMWUo5EYoetlEWm5rWam6rZl1+57p43I4a/Rton8aAJfFRXaWhhufjSdnRhmvDxcs5vYRBrSIJ+XnbiaKPWtOZ1YTqqpJ3q+gNgtFTT6jGlnIYpVqvTJ3Ah0RGJBfLVRyI1E/nVBiCjmIBh9evepif5bKcyLLI5dRZQyPzlg6UX296IsMCIrfkwYBOzrTZf1WcYjghoP9WjhiRTtqufQReQ+mgOhOSBdEzfyFecWR1JQtduWjWUCU8JkTUvSm5PvM9/a+sYpw0PyTMO88WDJvCzKl3PWWGCoydxVNdl7oeP3O7kYa6b/h6NxtKOEYLBcilPxTAatbRDxJIS4lAuHYxNuoByiZuFnj5xUpQOYd6zKupCyjwJFkgpw5ZkjiT8ah0UdOXJLSkbcBkzreQnNXKckp244tFNy2WdSCa5F6Zh2ZAD4kUmCVWXEH1krOTm2MvSmAe0mQACtYnN0SalpGFHbjLM0m8d5kcxNrW4iMT+HAcoK/kB77LFt6XJv3y6tvq1vzLze17jocSDIvBTK5VFR3vR37b5sZn2aWxdvNCY6upG0BWzzRXYTftFO12jNb3tr0YnEeJ1xHMR7ASRQSrOnARUkxC6SFU147kQ1XsJJThXpkSUvFhPepihVaHTqLUcLOptkE99tiyFSqw+5HyuQeHy5U6Fap85aRoyju60rOrqws2lY434UV2VSe66o93QKzxrtnkF/lp0y221+B8/taH2zhvGzSjV9nU8KAKf0N1x3jI/P2Jbyv80gUWwcuVc0IHmk0619tQzPnZ24xxXFzGMaGhrPPTZrzqCaXrpZ0nLsOq4zmQaueQlYrtUoZ4mQoib09UojadcsnJZNtDofFG2OrJ3AoaUMKpnU8OR66u8lorEuh5gqrm5A8zYng3on30eGhJGWXXhpwVl3Jgfo3VkxmbPcloONupYj/tIAkD8AEvizz3DIDCbTHT7alN4yd9v3fD+Ox7Ev9rvbew6gc8wYXfBXMhfFsxIxzWso6DxEFAjwofNehvQE+QcCdIKFSQ77CTfOfENLzzi15PhrIbK3SmSEMILJHPJVyVKKgr1oLBSem3MLObG0ePqhQ3E0RGZqVSP4HPHErbFErKYY3k2LDHIS9LaLOmw6RJFFUnBPT4y2qq/AYa5SZrZGNGXI1I3tRPzwocJMNREHp9TbjHr0+JVv4+TF71+3Sr+FH7O4bLvY5cJfM51HccuyYoPr2LUdac+OgGylE7iPXwxokY6w0oIO+0wxNODSLEp9fkRufr51RjqaEAoIALb+VaHVzh0tFMBs7bFN9JKMptGNVVbNtHlRIidzM3qujxsPK1GfULKwyZR2LmpjIPLm5AyRV/9bmS2VJe0dOfqMDdtBwqVeI0jpFSJU13Vt5GSkjKXNzZQM0hZWmrCEM3wy2Z1Fn3jh/Xkef+0ad3PJcF+hl0m8Bnt7U/tTpJW/rsOj+iGkUgj9jx8NKGanMa2oBD6Yl52iHhU7FJQzrw0aGNULBUWcjEMfwMSRikNOfy2UOlciWXnoRepMCexTlOwOX11BI1ypM5KHlngUYSNzw40SMs42kIibCGqOluc8lABl7aSsq2IkXOikRzhxuSY9pJEUoYQn+VRE1/a0vlZV83JdXFm+LN9vvY1CCNTzVrMDbX8k/+ybvjFX926bqf+CHFfwq4SODo8Co5vCVNTkyUADcfeo0esCNCKakYlKYQ2Shd7FIqiyAmGHBnYMTa1hLfjnfNgU3UpvZFe/hgRkXr9FV4SoHFQ6UKMftnDkbSiyzSIh1+u1Uoc82PxrAnzsYkaYDzSooxG0wWsk36k7EYS5iOOEpNlikwVWBbtI3ocdemi7UwjbWFZdBElBGV9KRNN2zYoMD8SXIZdCtEY2oavPR2PCxtvmkxf+brN615zgxnfLxZr94ddIvDTKwNHe7XaSRmfi+XDJ2JKGguR7FzZxJSzmNPpzstUkkT2hIb0ix07Yk42jY6mTHqRG8EE6nf6Er2dBzlandnygDnxsw51scdOiqKQBGeUgD4qarwowzN7cABSdxuCI3Vn2Mq4l6Dkw7Tatu3qBkj17AgsOrYsvRxmN2kXN+RAuTDeHjzY+K9M7V5g0qDVrK6Vfn7ldP3Z/zC2jg+j75a/e30osUsEPqk1P7LDD/v5d0xys5R2soZvdLMMX9JtNoajmJ7ErYa42onYif3V6Ow0HQ0hk8QqExIxgXSi+u3ZXE7r2tnwc5N86YdcNFi+lfHDTpYyNF7zQu2Yr/a/KhMNv8uLrXIilahM2+pGb+EV0NCQMHaNxEw+ax+hr0vHuskHLnQ5X2b9CJcfIWmsT84STCebSvgn5D5G3U1+tPaGLH3bh6pbnvEv45v2y/nufWGXCNxi8hXtMI6+6Jnmg0n5lc2aF2L6NGhlxKzQQv2yR17SHUKgWbl2G8CA5KsHAmFL1xDS8LMdEHTxGgsf80BZcjBtVxfmxk0dSSN5WjTqNJtGdGTTvPSQpar6CbZJyadxFAvJ6AeoyXg5wJHOja6CRvmubjSOCwOsE7OGo2sRTEBwZiz53EIznUfjdyb+l384XX/Gm9evfteefl/v3sbOE3hwsFww+Wl5VsfYiy6SURgfko8dA0MqKdh9+hF7A2JylkhFAcwtaRiGHjsgY0eSXBx1qCFaEi86oge/zFU1nznZbQcpm3lyZLU6kh8y1+kEc9b6Sb0hkiz0PKxpRSJUx4cKKqem6mo5DDRypAchKdOfraeQE149cDRPluVkUi78kNg4pmOpLsxceHqhmHaCg0Lkz7gRDkxiipjSRQHvqBVG78mCy27K0uddunHNCz8/sukqpj7QICbZGZw1cMSCS8KJ3yzLa4fXMnnpPq3YIJH0LTuCjuzV3m7+KR2Mj/QB9xKp6ahBGUd1+plECUg/Fyu8wqH5aCI6Gk+vAGFHKMlLKsT0TEcJXBJYDiRs8FNDYrgQE6FGMYJyl072dtHE/CQGO60nE1CTtGINSFykoBwK1G7URfYUax6EHhTQswXra181J80VZUKFN3/kJ0b2IORzyxhQTAHpYz8w414wPOr5l69O4q99ulb76ch8fpe3H8PZct64sL135QXdpR8vSKvLZzL3uwEamF1Gn3Y2IWF2okwIXWHoBekl27mEBsXliOJyYB+KXzqT41Amd+6crgL6CDtdfrnmoWyWvHBJFg7pcJVOtpYQaVqFEAmjpsYxkvGMpQSpyHzmI3moWELUkzD2UkdsvBbOoOjiw/xYfkOFMXPibf0I1k4PFAkijbUJ9vyNWohAERb2Ar5zws9mkvyOURP8ZDgJvvPxLat+g3nCPv0Qzu6CNc/8cWF717kXdLT8V1deW1CFAfmrBM3FZYWwdB47TMNKbUBUKFRddpCEbC85wmmvMR+rjaDrPhEQCDY63vq2G+GoKh5JbP0aJ6drGYWt0CooURlSYilmZQ4sR0dPxs3VdDJIpdIuxDj4pAye8jlKS1Dzkco5TcLm2SgHXpCb70PmRUu+LIXvhhjxw/qIMdduy/xv3V2Nr/jE1g38q9z9/srCzmDW+vPEy7s7Lj63XP5Eh5eV6nK9VTvD9pfdgQCIEi8M7uggPiGJDTdITl12sa1Ow2Hnqp6MwpTb/JUalNlOZnqXGUG/7Xxlini40zzpcWLsWS0hsKTROmt2lDGNahJyOhefzV8CzICnd/XLFEWS6gzWgT5MLqhhU7tyAHfqAMTBLmRGEPNf9PlCkQmYG2eB28YS75q1Jv/RzSb+xVc2zu+FgAciZntlnnh7f88/PDII3lnC6i0RAsPSZK90xqyjWWuc+kh0+rTIhppAO1Rk0nM6t2NKIRblhCRVomquevhorjrFIJw+SU/eySUzhoXoEiFhRvIjxNWv6tAVBcpUV9LNgS7MJHMpQ7KU/G3Y5UCHMgmg3lxwMVcmFRFlPEeB/Lzk5yXye7sCtELMaXO/YGqpMSNZMjqZh7+bNt5ld85Ur/rE2OabkXrus1MHJayV549/XT70r8dk8cv9hL+o5ViC8cWSlNBOcRljrz2rQgs5BXNaAbHGage7U6mSQ/UdgUWPiyyklU5nekiFwNS3JHGjcENGB8OiZMkCRQwdiYeIm8TRi3ZYctPvIjVnJ6MHYc1Q0DigGiKm0aCkRiXkgHTJJL0efLRiBH+EiAjC0IvErmNJmk0Y75YZv3jNlmr1D2vqtSuvCfJb/zA6v/cGHyxomHy++NKyZZ9cntdeGicxukZJSMjiS9imXUcCSV/ZrpTOz3XA4GjDsJ6KIbek0XGS0Bu3QmQsFBXQBYHlXQ3QtynhYmPWGGUlFwT4i2AtU+MIobtN0CCwaLAehOYo1W+AdaCqymWT/Jg360hX95TJU16SLxz4JSsbZpvkTAA5L3PxGm3IC1+InkabMi8Y2Rbn2zbFyZ+isPCDmSy+45ubh++82szvtasHK5x15wvva8uW/vuSLL1kJqujk9B1OhA2OldHIyhCThnBLpaRkgRGBEdP98/ovJPHhSD/K4KjH/Pj01K+F0AfVJeLpCQGc9IRX/wojFMGd/qXnbCLv0ujAKdkuJ4XKqHJHZTBa9d23DaePJmFKDthlRpRQNKhTvKxBBRXioCMOti0NLosx7dPhaBNtAH0ecWC8hD1KvLs4fO3Zp4Zq1fNZOKNt5dar58KovV/HB370/o8+2ratnzTN9deyYerD/qpwXyhvTN/BF9dNvSFJWn23FqaoIPYoUIFdB0/syBNhVskgi1FRih0pMc3I4ApQeCZAjo4AcmqUPLyaLoUetNpHqRTuZdOpEk6ldW8OM/rSZxsQ9o6+h9nXVJF/v66tRhEbRUvwEwRh0Xoey2RF4R8eW2KDNMkSE0apklSSLK8xBFcnoFFNchH/QUz/TwYpLKoJUdDJTJlUnWKISOJpT2U8yfnjGJ7KMPGN2/yofQER1YUlavG96u1JK0P1+sjtdi/uTOqXGtaK+tuHt80fvnw5nXXGHMjsthnfzC5P8BSa94ofG3Fki8OJsmzZlIdQ/lWGVlVS8dqX3OUJTnk3Qngkf6tVYI5HkcpJojMFJgzkafDBa9w67RfXLtmpnrHWBZe3ZtHq8aqyfRIFExvLXZU7/A25PUoSjeuqsabZCzlEkfxsN724NB6FFYqYTiZ1oKwlPgrTFbqqNdKrXkFx1BWnvDjjjRLuv0kHigFfjcOmO5S4LUUMNks+3kxzNMozMOyCcJylqUFP8v480+vmqelPEsj1JcnhgyjdOIHPv8jkaxN/DCc9vJsOs/DWhL4tarJqjP1vLatVhufzOO70iBal8zUN462eBtvrNdHrx4ZmULK5si6m7GzBG756pKBLy3Js6dy3ianST03N0ZZQmaH6GgSm1so0wkPQ00QT2Xe6m1p+LsJP/zVprT6p69uXnc3JnmbbNK9DdaaV6hKx5vWUlulFEalzO8wZc9L44IfplHRFHGGqOdBzH+h8HJeZK359WSiXq/9bmqKoydP+fY3VU3sbew0gb+yfOiLmEI8bRpTCPBX4BZwHJHlTeUYaDwMlr4vv7jiO9K2jOXZVSOp94M/jae//NzUJv7v2T75oowm9i/sLIELX12+7AtDWf2CKUz0mFgWURxnZfzhWxR1bpvwnbl5sGbE8/9vSy3/+v9uWn3dlfP8m9QmmpgvdpbA4ZcOWfafS9Lac6uxvYzECSIieIWogHVNgPnvliTcujX3vrkmzv77fVvX/hbRzdG2iT0CXj/aGWDp5lcTjLYccLlxpc6JQjvmE/U0NKtS7xfXJskLX7Zh9atB3l9ApUneJvYYdpbAHHBnPCzFOe7yLhKvahUwXdhqoq231tL3fn945Pnv27zh29CtapImmthz2FkCm/E4zfWPVjIs0rBwC0vmjiT7w2/r1QtfPbzxrd+oVnf4iv0mmthd2GkCT8zUJutxgvluYLyg1dxY937wfxPTF35wy5YfIZrT4Saa2GvYaQKPVSdX83cY9aBirkm9T35o/dqLvjU5eYuNbqKJvYqdJrDJi7dvK3WNXjlV/4+3rLnrFRuN2WJjmmhir0Nv6O8EHtbWHW9NvNvet3nNhxBsXmFoookmmmiiiSaaaKKJJprYazDm/wOs8YK9nJ+1fAAAAABJRU5ErkJggg=="/>
</defs>
</svg>


            </div>
            
            <h1>طلب إعادة تعيين كلمة المرور</h1>
            <p class="greeting">مرحباً بك في منصة التبرع بالدم،</p>
        </div>

        <!-- المحتوى -->
        <div class="content">
            <p>لقد تلقينا طلباً لإعادة تعيين كلمة المرور الخاصة بحسابك. يرجى استخدام الرمز التالي لإتمام العملية:</p>
            
            <div class="code-wrapper">
                <div class="code-box">
                    <div class="code-text">{{ $otp }}</div>
                </div>
            </div>
        </div>

        <!-- الملاحظات -->
        <div class="notice-box">
            <div class="warning-time">
                <span>⏳</span>
                <span>هذا الرمز صالح لمدة 5 دقائق فقط.</span>
            </div>
            <div style="opacity: 0.9;">
                إذا لم تكن أنت من قام بهذا الطلب، يمكنك تجاهل هذا البريد بأمان.
            </div>
        </div>

        <!-- التذييل -->
        <div class="footer">
            <p class="footer-logo-text">© {{ date('Y') }} منصة التبرع بالدم</p>
            <div class="slogan">
                <span class="heart-icon">❤️</span>
                <span>نَحْنُ مَعًا</span>
                <span class="heart-icon">❤️</span>
            </div>
        </div>

    </div>

</body>
</html>