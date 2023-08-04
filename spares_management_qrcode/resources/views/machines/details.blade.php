@extends('layout.app')
@section('content')
<div id="qrcode_print" style="width: 258px; height: 300px; margin-top: 42px; margin-bottom: 42px;margin-left: 15px; margin-right: 15px;">
    <div id="qrcode">
    </div>
    <div style="text-align: center; font-size: 20px; font-weight: 600; margin-top: 30px;">
        ID: {{$machine_detail->machine_id}}
    </div>
</div>
<!-- <div style="display: flex; justify-content: center; gap: 40px;" hidden> -->
</div>
<div class="container-fluid" style="padding-right: var(--bs-gutter-x,0rem); padding-left: var(--bs-gutter-x,0rem); margin-top: -50px;">
    <div class="main_container">
        <br>
        <!-- <br> -->
        <div class="mt-2"></div>
        
        <div style="margin-bottom: 15px; font-size: 20px; margin-left: 0px; display: flex; justify-content: space-between; gap: 10px; margin-right: 10px;">
            @if(Auth::check())
            <div>
                <a href="/dashboard/machines/all" style="text-decoration: none; margin-right: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M24 13.5H5.745L14.13 21.885L12 24L0 12L12 0L14.115 2.115L5.745 10.5H24V13.5Z"
                        fill="#1F7FD9" />
                    </svg>
                </a>
            </div>
            @endif
            <div>
                <b> Machine Details </b>
            </div>
            @if(Auth::check())
            <div onclick="printQR();" style="cursor: pointer;">

                <svg width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 23.4627C12 22.8948 12 22.6108 12.1136 22.4023C12.1772 22.2855 12.2644 22.1874 12.3682 22.1159C12.5536 21.988 12.806 21.988 13.3108 21.988H13.7349C14.4619 21.988 14.8254 21.988 15.0513 22.2421C15.2771 22.4962 15.2771 22.9051 15.2771 23.723V24.2001C15.2771 24.768 15.2771 25.052 15.1635 25.2606C15.0999 25.3773 15.0127 25.4754 14.9089 25.547C14.7235 25.6748 14.4711 25.6748 13.9663 25.6748C13.209 25.6748 12.8304 25.6748 12.5523 25.483C12.3967 25.3758 12.2658 25.2286 12.1704 25.0535" fill="#11141D"/>
                    <path d="M12 23.4627C12 22.8948 12 22.6108 12.1136 22.4023C12.1772 22.2855 12.2644 22.1874 12.3682 22.1159C12.5536 21.988 12.806 21.988 13.3108 21.988H13.7349C14.4619 21.988 14.8254 21.988 15.0513 22.2421C15.2771 22.4962 15.2771 22.9051 15.2771 23.723V24.2001C15.2771 24.768 15.2771 25.052 15.1635 25.2606C15.0999 25.3773 15.0127 25.4754 14.9089 25.547C14.7235 25.6748 14.4711 25.6748 13.9663 25.6748C13.209 25.6748 12.8304 25.6748 12.5523 25.483C12.3967 25.3758 12.2658 25.2286 12.1704 25.0535" stroke="#66B3EB" stroke-linecap="round"/>
                    <path d="M19.7109 19.212C19.7109 19.78 19.7109 20.0639 19.5973 20.2725C19.5338 20.3893 19.4465 20.4874 19.3428 20.5589C19.1573 20.6867 18.9049 20.6867 18.4001 20.6867H17.976C17.249 20.6867 16.8855 20.6867 16.6597 20.4327C16.4338 20.1786 16.4338 19.7697 16.4338 18.9518V18.4747C16.4338 17.9068 16.4338 17.6228 16.5475 17.4142C16.611 17.2975 16.6983 17.1994 16.802 17.1278C16.9874 17 17.2399 17 17.7447 17C18.5019 17 18.8805 17 19.1587 17.1917C19.3143 17.299 19.4452 17.4462 19.5405 17.6213" fill="#11141D"/>
                    <path d="M19.7109 19.212C19.7109 19.78 19.7109 20.0639 19.5973 20.2725C19.5338 20.3893 19.4465 20.4874 19.3428 20.5589C19.1573 20.6867 18.9049 20.6867 18.4001 20.6867H17.976C17.249 20.6867 16.8855 20.6867 16.6597 20.4327C16.4338 20.1786 16.4338 19.7697 16.4338 18.9518V18.4747C16.4338 17.9068 16.4338 17.6228 16.5475 17.4142C16.611 17.2975 16.6983 17.1994 16.802 17.1278C16.9874 17 17.2399 17 17.7447 17C18.5019 17 18.8805 17 19.1587 17.1917C19.3143 17.299 19.4452 17.4462 19.5405 17.6213" stroke="#66B3EB" stroke-linecap="round"/>
                    <path d="M17.5903 18.8432C17.5903 18.6196 17.5903 18.5079 17.6401 18.4289C17.6577 18.4011 17.6793 18.3768 17.704 18.357C17.7742 18.301 17.8736 18.301 18.0723 18.301C18.271 18.301 18.3703 18.301 18.4405 18.357C18.4652 18.3768 18.4868 18.4011 18.5044 18.4289C18.5542 18.5079 18.5542 18.6196 18.5542 18.8432C18.5542 19.0667 18.5542 19.1785 18.5044 19.2574C18.4868 19.2853 18.4652 19.3096 18.4405 19.3294C18.3703 19.3854 18.271 19.3854 18.0723 19.3854C17.8736 19.3854 17.7742 19.3854 17.704 19.3294C17.6793 19.3096 17.6577 19.2853 17.6401 19.2574C17.5903 19.1785 17.5903 19.0667 17.5903 18.8432Z" fill="#11141D"/>
                    <path d="M16.1445 25.6746C16.1445 25.8543 16.274 25.9999 16.4337 25.9999C16.5934 25.9999 16.7228 25.8543 16.7228 25.6746H16.1445ZM18.5542 21.6626H17.7831V22.3132H18.5542V21.6626ZM16.1445 24.3734V25.6746H16.7228V24.3734H16.1445ZM17.7831 21.6626C17.5184 21.6626 17.2981 21.6622 17.1203 21.6825C16.9378 21.7034 16.7684 21.7489 16.6157 21.8636L16.937 22.4046C16.9788 22.3731 17.0421 22.3455 17.1789 22.3298C17.3205 22.3136 17.5063 22.3132 17.7831 22.3132V21.6626ZM16.7228 23.506C16.7228 23.1946 16.7232 22.9856 16.7376 22.8262C16.7515 22.6723 16.7761 22.6012 16.8041 22.5541L16.3232 22.1927C16.2212 22.3645 16.1808 22.555 16.1623 22.7604C16.1442 22.9603 16.1445 23.2082 16.1445 23.506H16.7228ZM16.6157 21.8636C16.5 21.9506 16.4006 22.0625 16.3232 22.1927L16.8041 22.5541C16.8392 22.4949 16.8844 22.4441 16.937 22.4046L16.6157 21.8636Z" fill="#11141D"/>
                    <path d="M20.0001 21.9879C20.0001 21.8082 19.8706 21.6626 19.7109 21.6626C19.5512 21.6626 19.4218 21.8082 19.4218 21.9879H20.0001ZM17.7832 25.9999H18.5543V25.3493H17.7832V25.9999ZM20.0001 23.506V21.9879H19.4218V23.506H20.0001ZM18.5543 25.9999C18.73 25.9999 18.8762 26.0001 18.9959 25.9909C19.1181 25.9816 19.2336 25.9613 19.3456 25.9092L19.1243 25.3081C19.0945 25.3219 19.0493 25.3347 18.9565 25.3418C18.8611 25.3492 18.7379 25.3493 18.5543 25.3493V25.9999ZM19.4218 24.3734C19.4218 24.58 19.4216 24.7186 19.4151 24.826C19.4088 24.9304 19.3974 24.9812 19.3851 25.0147L19.9194 25.2636C19.9658 25.1377 19.9837 25.0078 19.9921 24.8702C20.0002 24.7356 20.0001 24.5711 20.0001 24.3734H19.4218ZM19.3456 25.9092C19.6054 25.7881 19.8118 25.5559 19.9194 25.2636L19.3851 25.0147C19.3362 25.1475 19.2423 25.253 19.1243 25.3081L19.3456 25.9092Z" fill="#11141D"/>
                    <path d="M12 19.212C12 18.3602 12 17.9342 12.1704 17.6213C12.2658 17.4462 12.3967 17.299 12.5523 17.1917C12.8304 17 13.209 17 13.9663 17C14.4711 17 14.7235 17 14.9089 17.1278C15.0127 17.1994 15.0999 17.2975 15.1635 17.4142C15.2771 17.6228 15.2771 17.9068 15.2771 18.4747V18.9518C15.2771 19.7697 15.2771 20.1786 15.0513 20.4327C14.8254 20.6867 14.4619 20.6867 13.7349 20.6867H13.3108C12.806 20.6867 12.5536 20.6867 12.3682 20.5589C12.2644 20.4874 12.1772 20.3893 12.1136 20.2725C12 20.0639 12 19.78 12 19.212Z" fill="#11141D" stroke="#66B3EB"/>
                    <path d="M13.1565 18.8432C13.1565 18.6196 13.1565 18.5079 13.2063 18.4289C13.2238 18.4011 13.2454 18.3768 13.2702 18.357C13.3404 18.301 13.4397 18.301 13.6384 18.301C13.8371 18.301 13.9365 18.301 14.0066 18.357C14.0314 18.3768 14.053 18.4011 14.0706 18.4289C14.1203 18.5079 14.1203 18.6196 14.1203 18.8432C14.1203 19.0667 14.1203 19.1785 14.0706 19.2574C14.053 19.2853 14.0314 19.3096 14.0066 19.3294C13.9365 19.3854 13.8371 19.3854 13.6384 19.3854C13.4397 19.3854 13.3404 19.3854 13.2702 19.3294C13.2454 19.3096 13.2238 19.2853 13.2063 19.2574C13.1565 19.1785 13.1565 19.0667 13.1565 18.8432Z" fill="#11141D"/>
                    <path d="M13.1565 23.8315C13.1565 23.6079 13.1565 23.4962 13.2063 23.4172C13.2238 23.3894 13.2454 23.3651 13.2702 23.3453C13.3404 23.2893 13.4397 23.2893 13.6384 23.2893C13.8371 23.2893 13.9365 23.2893 14.0066 23.3453C14.0314 23.3651 14.053 23.3894 14.0706 23.4172C14.1203 23.4962 14.1203 23.6079 14.1203 23.8315C14.1203 24.055 14.1203 24.1668 14.0706 24.2457C14.053 24.2736 14.0314 24.2979 14.0066 24.3176C13.9365 24.3736 13.8371 24.3736 13.6384 24.3736C13.4397 24.3736 13.3404 24.3736 13.2702 24.3176C13.2454 24.2979 13.2238 24.2736 13.2063 24.2457C13.1565 24.1668 13.1565 24.055 13.1565 23.8315Z" fill="#11141D"/>
                    <path d="M17.3977 23.8313C17.3977 23.5267 17.3977 23.3744 17.4627 23.265C17.4908 23.2177 17.5269 23.177 17.569 23.1454C17.6663 23.0723 17.8017 23.0723 18.0724 23.0723C18.3431 23.0723 18.4785 23.0723 18.5758 23.1454C18.6179 23.177 18.654 23.2177 18.6821 23.265C18.7471 23.3744 18.7471 23.5267 18.7471 23.8313C18.7471 24.1359 18.7471 24.2882 18.6821 24.3976C18.654 24.4449 18.6179 24.4856 18.5758 24.5173C18.4785 24.5903 18.3431 24.5903 18.0724 24.5903C17.8017 24.5903 17.6663 24.5903 17.569 24.5173C17.5269 24.4856 17.4908 24.4449 17.4627 24.3976C17.3977 24.2882 17.3977 24.1359 17.3977 23.8313Z" fill="#11141D"/>
                    <path d="M7 23.348C4.66983 23.2827 3.27997 23.0409 2.31802 22.146C1 20.9199 1 18.9466 1 15C1 11.0534 1 9.08006 2.31802 7.85399C3.63604 6.62793 5.75736 6.62793 10 6.62793H22C26.2426 6.62793 28.3639 6.62793 29.6819 7.85399C31 9.08006 31 11.0534 31 15C31 18.9466 31 20.9199 29.6819 22.146C28.72 23.0409 27.3303 23.2827 25 23.348" stroke="#1F7FEA" stroke-width="1.5"/>
                    <path d="M26.125 15C26.125 14.422 25.6213 13.9535 25 13.9535C24.3787 13.9535 23.875 14.422 23.875 15H26.125ZM8.125 15C8.125 14.422 7.62132 13.9535 7 13.9535C6.37869 13.9535 5.875 14.422 5.875 15H8.125ZM23.875 20.5814C23.875 22.5843 23.8726 23.9812 23.7204 25.0352C23.5723 26.0591 23.3017 26.6012 22.8865 26.9874L24.4776 28.4675C25.3804 27.6275 25.7688 26.5701 25.9503 25.3141C26.1274 24.0882 26.125 22.5251 26.125 20.5814H23.875ZM16 30C18.0895 30 19.7698 30.0022 21.0877 29.8374C22.4379 29.6686 23.5746 29.3073 24.4776 28.4675L22.8865 26.9874C22.4713 27.3737 21.8886 27.6254 20.7879 27.7631C19.6548 27.9047 18.1531 27.907 16 27.907V30ZM16 2.09302C18.1531 2.09302 19.6548 2.09524 20.7879 2.23695C21.8886 2.37461 22.4713 2.6264 22.8865 3.01257L24.4776 1.53258C23.5746 0.692694 22.4379 0.331453 21.0877 0.162588C19.7698 -0.00221701 18.0895 1.52492e-06 16 1.52492e-06V2.09302ZM16 1.52492e-06C13.9105 1.52492e-06 12.2302 -0.00221701 10.9124 0.162588C9.56221 0.331453 8.42541 0.692694 7.52253 1.53258L9.11352 3.01257C9.52866 2.6264 10.1115 2.37461 11.2122 2.23695C12.3452 2.09524 13.8469 2.09302 16 2.09302V1.52492e-06ZM5.875 20.5814C5.875 22.5251 5.87262 24.0882 6.04978 25.3141C6.23131 26.5701 6.61965 27.6275 7.52253 28.4675L9.11352 26.9874C8.69838 26.6012 8.4277 26.0591 8.27973 25.0352C8.12739 23.9812 8.125 22.5843 8.125 20.5814H5.875ZM16 27.907C13.8469 27.907 12.3452 27.9047 11.2122 27.7631C10.1115 27.6254 9.52866 27.3737 9.11352 26.9874L7.52253 28.4675C8.42541 29.3073 9.56221 29.6686 10.9124 29.8374C12.2302 30.0022 13.9105 30 16 30V27.907ZM26.0985 6.59639C26.0289 4.44448 25.7856 2.74935 24.4776 1.53258L22.8865 3.01257C23.5024 3.58549 23.7789 4.47614 23.8495 6.65943L26.0985 6.59639ZM8.15047 6.65943C8.2212 4.47614 8.49763 3.58549 9.11352 3.01257L7.52253 1.53258C6.2145 2.74935 5.9712 4.44448 5.90149 6.59639L8.15047 6.65943ZM26.125 20.5814V15H23.875V20.5814H26.125ZM8.125 20.5814V15H5.875V20.5814H8.125Z" fill="#01EAFE"/>
                    <path d="M27.25 15.6186C24.8094 14.5992 21.1172 13.605 16 13.605C10.8828 13.605 7.19068 14.5992 4.75 15.6186" stroke="#325EF1" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
                
            @endif
        </div>

        <div style="margin-bottom: 15px; font-size: 30px; font-weight: 600; text-align: center; word-wrap: break-word;">
            <u> ID: {{$machine_detail->machine_id}} </u>
        </div>
        @if(count($machine_detail->medias)>0)
        <div style="display: flex; justify-content: center; align-items: center; width: 95%; aspect-ratio: 1/0.70; margin-left: 2%;">
            <img src="{{$machine_detail->medias[0]->path}}" alt="" srcset="" width="100%" height="100%" class="gallery-item" val="{{$machine_detail->medias[0]->path}}" media_type="image">
        </div>
        @endif

        <div class="accordion-item" style="margin: 10px 0px;">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Images
                    @php($details_image_count=0)
                    @if(count($machine_detail->medias) !== 0)
                    @foreach($machine_detail->medias as $media)
                    @if($media->for_status == "detail" &&
                    ($media->media_type == "image" || $media->media_type == "video"))
                    @php($details_image_count++)
                    @endif
                    @endforeach
                    @endif

                    <span style="padding-left: 20px;">
                        @if($details_image_count != 0)
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 100 100"
                            id="attachment">
                            <path
                                d="M18.8 85.1c-7.8-7.8-7.8-20.5 0-28.3L63.1 13c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8L38.6 76.7c-3.1 3.1-8.2 3.1-11.3 0-3.1-3.1-3.1-8.2 0-11.3l22.3-21.8c.8-.8 2.1-.8 2.8 0 .8.8.8 2.1 0 2.8L30.2 68.2c-1.5 1.5-1.5 4.1 0 5.6 1.6 1.6 4.1 1.6 5.7 0L80.2 30c3.9-3.9 3.9-10.2 0-14.1-3.9-3.9-10.2-3.9-14.1 0L21.7 59.7c-6.2 6.2-6.2 16.4 0 22.6 6.3 6.2 16.4 6.2 22.6 0l38.3-37.8c.8-.8 2.1-.8 2.8 0 .8.8.8 2.1 0 2.8L47.1 85.2c-7.8 7.7-20.4 7.8-28.3-.1z">
                            </path>
                            <path fill="#00F" d="M664-510v1684h-1784V-510H664m8-8h-1800v1700H672V-518z"></path>
                        </svg>
                        @else
                        <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M6.732 14.732l2.586-2.586.707.708-2.586 2.585a1.5 1.5 0 0 0 2.117 2.126l2.606-2.575.706.707-2.61 2.58a2.5 2.5 0 0 1-3.526-3.545zm3.964 5.935a4.5 4.5 0 1 1-6.364-6.363l3.59-3.553-.706-.707-3.587 3.55a5.5 5.5 0 1 0 7.778 7.777l3.549-3.587-.708-.708zm11.658.98l-.707.706-20-20 .707-.707 6.639 6.64 6.192-6.127a4 4 0 1 1 5.63 5.683l-6.169 6.097 1.36 1.36 3.67-3.71.712.702-3.675 3.715zM9.7 8.992l1.386 1.386 3.646-3.647.707.707-3.646 3.647 2.146 2.146 6.172-6.1a3 3 0 1 0-4.223-4.263z">
                                </path>
                                <path fill="none" d="M0 0h24v24H0z"></path>
                            </g>
                        </svg>
                        @endif
                    </span>
                </button>

            </h2>

            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">

                    <section class="gallery">
                        <div class="container-lg">
                            <div class="row gy-2 row-cols-2 row-cols-sm-2 row-cols-md-3">
                                @php($detail_image=0)
                                @if(count($machine_detail->medias) != 0)
                                @foreach($machine_detail->medias as $media)
                                @if($media->for_status == "detail" && $media->media_type == "image")
                                @php($detail_image++)

                                <div class="col" style="position: relative;">
                                    <img src="{{$media->thumbnail_path}}" class="gallery-item" alt="gallery"
                                        val="{{$media->path}}" media_type="image">

                                    <!-- <a href="" class="delete_button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="25"
                                            viewBox="0 0 22 25" fill="none">
                                            <circle cx="11" cy="11" r="10" fill="#F7F6F5" stroke="#F72C1D"
                                                stroke-width="2" />
                                            <path
                                                d="M7.36 15L10.432 10.776L7.396 6.6H9.202L11.338 9.54L13.48 6.6H15.286L12.25 10.776L15.322 15H13.504L11.338 12.024L9.178 15H7.36Z"
                                                fill="#0D1B2A" />
                                        </svg>
                                    </a> -->

                                </div>
                                @endif

                                @if($media->for_status == "detail" && $media->media_type == "video")
                                @php($detail_image++)

                                <div class="col" style="position: relative;">
                                    <video src="{{$media->path}}" class="gallery-item" alt="video"
                                        val="{{$media->path}}" media_type="video"></video>

                                    <!-- <a href="" class="delete_button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="25"
                                            viewBox="0 0 22 25" fill="none">
                                            <circle cx="11" cy="11" r="10" fill="#F7F6F5" stroke="#F72C1D"
                                                stroke-width="2" />
                                            <path
                                                d="M7.36 15L10.432 10.776L7.396 6.6H9.202L11.338 9.54L13.48 6.6H15.286L12.25 10.776L15.322 15H13.504L11.338 12.024L9.178 15H7.36Z"
                                                fill="#0D1B2A" />
                                        </svg>
                                    </a> -->

                                </div>
                                @endif
                                @endforeach
                                @endif

                                @if($detail_image == 0)
                                <p style="margin: 20px auto; color: #8B8B8B; display: flex; justify-content: center;">
                                    Images not available</p>
                                @endif

                            </div>
                        </div>
                    </section>


                </div>
            </div>
        </div>
        @if($machine_detail->department && $machine_detail->department == 'mcl')
        <div style="text-align: center; font-size: 24px; font-weight: 600; color: #1171EA;">
            <u> MCL General Layout </u>
        </div>
        <div style="display: flex; justify-content: center; align-items: center; width: 95%; margin-left: 2%; margin-top: 20px; margin-bottom: 25px;">
            <img src="\dist\assets\mcl_general_layout.png" alt="" srcset="" width="100%" height="100%" class="gallery-item" val="\dist\assets\mcl_general_layout.png" media_type="image">
        </div>
        @endif
        <div style="font-size: 24px; font-weight: 600; margin-left: 3%; display: flex; justify-content: space-between;">
            <div>
                <u> Details </u>
            </div>
            @if(Auth::check())
            <a href="/update_machine/{{$machine_detail->id}}">
                <div style="padding:0 8px;height: 28px; background-color: #0D1B2A; color: white; display: flex; justify-content: center; align-items: center; font-size: 16px; border-radius: 5px; cursor: pointer;">
                    Update
                </div>
            </a>
            @endif
        </div>
        <div style="font-size: 18px; letter-spacing: 2px; margin-left: 20px; word-spacing: 10px; margin-top: 10px;">
            <b>Name: </b> @if($machine_detail->machine_name) {{$machine_detail->machine_name}} @else N.A. @endif
        </div>
        <div style="font-size: 18px; letter-spacing: 2px; margin-left: 20px; word-spacing: 10px; margin-top: 5px;">
            <b>Type: </b> @if($machine_detail->machine_type) {{$machine_detail->machine_type}} @else N.A. @endif
        </div>
        <div style="font-size: 18px; letter-spacing: 2px; margin-left: 20px; word-spacing: 10px; margin-top: 5px;">
            <b>Department: </b> 
            @if($machine_detail->department && $machine_detail->department == 'mcl') MCL 
            @elseif($machine_detail->department && $machine_detail->department == 'ccl') CCL
            @elseif($machine_detail->department && $machine_detail->department == 'mechanical_maintenance') Mechanical Maintenance
            @else N.A. @endif
        </div>
        <div style="font-size: 18px; letter-spacing: 2px; margin-left: 20px; word-spacing: 10px; margin-top: 5px;">
            <b>Description: </b> @if($machine_detail->description) {{$machine_detail->description}} @else N.A. @endif
        </div>
        <div style="font-size: 18px; letter-spacing: 2px; margin-left: 20px; word-spacing: 10px; margin-top: 5px;">
            <b>Last Maintenance: </b> @if($machine_detail->last_maintenance_date) {{Carbon\Carbon::parse($machine_detail->last_maintenance_date)->format('d-m-y')}} @else N.A. @endif
        </div>
        <div style="font-size: 18px; letter-spacing: 2px; margin-left: 20px; word-spacing: 10px; margin-top: 5px;">
            <b>Due Maintenance: </b> @if($machine_detail->due_maintenance_date) {{Carbon\Carbon::parse($machine_detail->due_maintenance_date)->format('d-m-y')}} @else N.A. @endif
        </div>
        <div style="font-size: 18px; letter-spacing: 2px; margin-left: 20px; word-spacing: 10px; margin-top: 5px;">
            <b>Operation Started: </b> @if($machine_detail->operation_start_date) {{Carbon\Carbon::parse($machine_detail->operation_start_date)->format('d-m-y')}} @else N.A. @endif
        </div>
        
        @if(count($machine_detail->maintenances)>0)
        <div style="font-size: 24px; font-weight: 600; margin-left: 3%; margin-top: 20px;">
            <u> Maintenance History </u>
        </div>
        <table style="margin: 10px;  width: calc( 100% - 20px);">
            <thead>
                <th style="padding: 15px 5px; border: 2px solid black; font-weight: 600; width: 15%; text-align: center;" ><u> Sl. No.</u></th>
                <th style="padding: 15px; border: 2px solid black; font-weight: 600; width: 65%; text-align: center;" ><u> Defect</u></th>
                <th style="padding: 15px; border: 2px solid black; font-weight: 600; width: 20%; text-align: center;" ><u> Date</u></th>
            </thead>
            <tbody>
                @foreach($machine_detail->maintenances as $key => $maintenance)
                    <tr> 
                        <td style="padding: 15px; border: 2px solid black; width: 15%; text-align: center;">{{$key+1}} </td>
                        <td style="padding: 15px; border: 2px solid black; width: 65%; text-align: justify;">{{$maintenance->defect}}</td>
                        <td style="padding: 15px 5px; border: 2px solid black; width: 20%; text-align: center;">@if($maintenance->maintenance_completed) {{Carbon\Carbon::parse($maintenance->maintenance_completed)->format('d-m-y')}} @else Not resolved yet @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        @if(count($spares)>0)
        <div style="font-size: 24px; font-weight: 600; margin-left: 3%; margin-top: 20px;">
            <u> Spare Parts </u>
        </div>
        <div style="margin: 15px 5px;">
            @foreach($spares as $key => $spare)
            <a href="/spare/{{$spare->id}}">
                <div style="display: flex; justify-content: left; gap: 0px 10px; margin: 10px 10px; border-radius: 5px; background-color: #ecebe9; padding: 10px; cursor: pointer;">
                    <div style="width: 15px; text-align: center; justify-content: center; display: flex; align-items: center; font-weight: 600; font-size: 18px;">
                        {{$key+1}}
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; width: 80px; aspect-ratio: 1/1; margin-left: 2%;">
                        <img src="{{$spare->medias[0]->thumbnail_path}}" alt="spare{{$key+1}}" srcset="" width="100%" height="100%">
                    </div>
                    <div style="display: flex; align-items: center; width: auto; font-size: 18px; font-weight: 600; text-align: justify;">
                        {{$spare->spare_name}}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        
<!-- Modal -->
<div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="modal-img" alt="modal img" id="media_img">
                <video src="" class="modal-vid" alt="modal img" controls="true" id="media_vid"></video>
            </div>
        </div>
    </div>
</div>
<br><br>
<script src="/dist/frontend/js/model_main.js"></script>

<style>
    .main_container {
    margin: auto;
    width: 90%;
    max-width: 70vh;
}

.gallery-item {
    width: 100%;
    height: 100%;
    background-color: #D1D1D1;
    border: 3px solid white;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    cursor: pointer;
}
.accordion-button:focus {
    z-index: 0;
}

.accordion-button {
    padding: 0.8rem 0.5rem;
    font-weight: bold;
    font-size: 20px;
}

.accordion-button:not(.collapsed) {
    color: black;
}

.accordion-body {
    padding: 0rem 0rem;
    height: 200px;
    overflow-y: scroll;
}
.gallery {
    /* background-color: #dbddf1; */
    padding: 10px 0;
}

.gallery img {
    background-color: #ffffff;
    width: 100%;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    cursor: pointer;
}

#gallery-modal .modal-img {
    width: 100%;
    height: 100%;
}

#gallery-modal .modal-vid {
    width: 100%;
    height: 100%;
}

.row {
    --bs-gutter-x: 0.5rem;
}

.modal-body {
    padding: 0.2rem;
}

.modal-header {
    padding: 0.2rem 0.5rem;
}
#qrcode_print{
    display: none;
}
@media print{
    #qrcode_print{
        display: block;
    }
}
</style>
<style>
    @page {
      margin: 0;
    }
    @media print {
      footer {
        display: none;
        position: fixed;
        bottom: 0;
      }
      header {
        display: none;
        position: fixed;
        top: 0;
      }
    }
    </style>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <!-- <script src="https://cdn.rawgit.com/papnkukn/qrcode-svg/gh-pages/qrcode.min.js"></script>    -->
<script>
function generateQRCode(data, elementId) {
    var qr = new QRCode(
        document.getElementById(elementId),
        {
            text: data,
            width: 250,
            height: 250,
        }
    );
    qrElement.innerHTML = qr.createImgTag();
}
generateQRCode_parent();

function printQR()
{
    var content = document.getElementById('qrcode_print');
    var cloneDiv = content.cloneNode(true);
    var tempContainer = document.createElement('div');
    tempContainer.appendChild(cloneDiv);
    tempContainer.hidden=false;
    var printWindow = window.open('', '');
    printWindow.document.write('<html><body></body></html>');
    printWindow.document.body.appendChild(tempContainer);
    printWindow.document.close();
    printWindow.print();
    // document.getElementById('qrcode').innerHTML = '';
}
// Example usage
function generateQRCode_parent()
{
    var information = window.location.href;
    var qrCode = generateQRCode(information, "qrcode");
    // addLogoToQRCode(qrCode, '/dist/assets/logo.png');
    // document.getElementById('generate_button').style.display = none;
    // generateQRCode(information, "qrcode");
    // document.addEventListener("DOMContentLoaded", function() {
// });
}
</script>

@endsection