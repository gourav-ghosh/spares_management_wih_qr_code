@extends('layout.app')
@section('content')
<div class="container-fluid" style="padding-right: var(--bs-gutter-x,0rem); padding-left: var(--bs-gutter-x,0rem);">
    @if($place)
    <!-- Add place bar on top -->
    <div class="scrollmenu">

        <a id="workshop" type="button" href="/dashboard/spares/workshop" name="answer" id="btn0"
            class="notifier new">
            Workshop
            <!-- <span class="badge_style" id="workshop1"></span> -->
        </a>
        <a id="roll_stand" type="button" href="/dashboard/spares/roll_stand" name="answer" id="btn0"
            class="notifier new">
            Roll Stand
            <!-- <span class="badge_style" id="roll_stand1"></span> -->
        </a>

        <a id="spm" type="button" href="/dashboard/spares/spm" name="answer"
            id="btn3" class="notifier new">
            SPM Area
            <!-- <span class="badge_style" id="spm1"></span> -->
        </a>

        <a id="os_mcl" type="button" href="/dashboard/spares/os_mcl" name="answer" id="btn4"
            class="notifier new">
            Oil Storage MCL
            <!-- <span class="badge_style" id="os_mcl1"></span> -->
        </a>

        <a id="os_ccl" type="button" href="/dashboard/spares/os_ccl" name="answer"
            id="btn5" class="notifier new">
            Oil Storage CCL
            <!-- <span class="badge_style" id="os_ccl1"></span> -->
        </a>

        <a id="mcl_exit" type="button" href="/dashboard/spares/mcl_exit" name="answer" id="btn1"
            class="notifier new">
            MCL Exit
            <!-- <span class="badge_style" id="mcl_exit1"></span> -->
        </a>
        <a id="jk_bay" type="button" href="/dashboard/spares/jk_bay" name="answer" id="btn1"
            class="notifier new">
            JK Bay
            <!-- <span class="badge_style" id="jk_bay1"></span> -->
        </a>
        <a id="de_bay" type="button" href="/dashboard/spares/de_bay" name="answer" id="btn1"
            class="notifier new">
            CCL DE Bay
            <!-- <span class="badge_style" id="de_bay1"></span> -->
        </a>
        <a id="cd_bay" type="button" href="/dashboard/spares/cd_bay" name="answer" id="btn1"
            class="notifier new">
            MCL CD Bay
            <!-- <span class="badge_style" id="cd_bay1"></span> -->
        </a>

    </div>
    @endif
    <div class="container text-center">
        <br>
        <!-- <br> -->
        <div class="mt-2"></div>
        <a href="/add_spare">
            <div class="floating-button">
                <svg width="79" height="78" viewBox="0 0 79 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_24_2)">
                    <g filter="url(#filter0_d_24_2)">
                    <path d="M32 0C14.3264 0 0 14.3264 0 32C0 49.6736 14.3264 64 32 64C49.6736 64 64 49.6736 64 32C64 14.3264 49.6736 0 32 0ZM48 35.2H35.2V48H28.8V35.2H16V28.8H28.8V16H35.2V28.8H48V35.2Z" fill="url(#paint0_linear_24_2)"/>
                    </g>
                    <path d="M35.2001 16H28.8V48H35.2001V16Z" fill="#F7F6F5"/>
                    <path d="M48 28.8H16V35.2001H48V28.8Z" fill="#F7F6F5"/>
                    </g>
                    <defs>
                    <filter id="filter0_d_24_2" x="0" y="0" width="79" height="78" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                    <feOffset dx="9" dy="8"/>
                    <feGaussianBlur stdDeviation="3"/>
                    <feComposite in2="hardAlpha" operator="out"/>
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_24_2"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_24_2" result="shape"/>
                    </filter>
                    <linearGradient id="paint0_linear_24_2" x1="60.5" y1="47.5" x2="5" y2="12" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#1F7FEA" stop-opacity="0.5"/>
                    <stop offset="1" stop-color="#01EAFE"/>
                    </linearGradient>
                    <clipPath id="clip0_24_2">
                    <rect width="79" height="78" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>       
            </div>
        </a>
        @if(count($spares)>0)
        @foreach($spares as $spare)
        <div style="margin-bottom:20px;" class="maindiv">
            <form action="/spare/{{$spare->id}}">
                <button type="submit" class="button">
                    <div style="display: flex; justify-content: left; gap: 4%; flex-wrap: wrap; align-items: safe ;">
                        <div style="width: 45%;">
                            <img style="border-radius: 6px;" src="{{$spare->medias[0]->thumbnail_path}}" alt="{{$spare->spare_name}} image" srcset="" width="95%">
                        </div>
                        <div style="word-wrap: normal; width: 48%;">
                            <div style="word-wrap: break-word; margin: 5px 0px;">
                                <span style="font-weight: 600; font-size: 18px;"> Id: @if($spare->spare_id){{$spare->spare_id}} @else Not Available @endif</span>
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px;">
                                <span style="font-weight: 500; font-size: 16px; "> Name: @if($spare->spare_name){{$spare->spare_name}} @else Not Available @endif</span>
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px;">
                                <span style="font-weight: 500; font-size: 16px; "> Department: @if($spare->department && $spare->department == 'mcl') MCL 
                                    @elseif($spare->department && $spare->department == 'ccl') CCL
                                    @elseif($spare->department && $spare->department == 'mechanical_maintenance') Mechanical Maintenance
                                    @else Not Available @endif</span>
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px;">
                                <span style="font-weight: 500; font-size: 16px; "> Type: @if($spare->spare_type){{$spare->spare_type}} @else Not Available @endif</span>
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px;">
                                <span style="font-weight: 500; font-size: 16px; "> Storage: @if($spare->spare_storage && $spare->spare_storage == 'roll_stand') Roll Stand 
                                    @elseif($spare->spare_storage && $spare->spare_storage == 'workshop') Workshop Area
                                    @elseif($spare->spare_storage && $spare->spare_storage == 'spm') SPM Area
                                    @elseif($spare->spare_storage && $spare->spare_storage == 'os_mcl') Oil Storage MCL
                                    @elseif($spare->spare_storage && $spare->spare_storage == 'os_ccl') Oil Storage CCL
                                    @elseif($spare->spare_storage && $spare->spare_storage == 'mcl_exit') MCL Exit
                                    @elseif($spare->spare_storage && $spare->spare_storage == 'jk_bay') JK Bay Area
                                    @elseif($spare->spare_storage && $spare->spare_storage == 'de_bay') CCL DE Bay area
                                    @elseif($spare->spare_storage && $spare->spare_storage == 'cd_bay') MCL CD Bay area
                                    @else Not Available @endif</span>
                            </div>
                        </div>
                    </div>
                    <div style="width: 90%; word-wrap: break-word; margin: 10px;">
                        <span style="margin-right: 5px;">Description :</span>
                        @if($spare->description)
                        {{$spare->description}}
                        @else Not Available @endif
                    </div>
                </button>
            </form>
            </div>
        @endforeach
        @else
        <h5 style="margin: 20px auto; color:#F72C1D;"> No Spares Found</h5>
        @endif
    </div>

    @if($spares_count > $per_page)
        <br>
        <div class="pagination-wrapper" style="width: 100%; max-width: 415px; margin: auto;">
            <div style="display: flex;justify-content: left; align-items: center;margin-bottom: -8px;">
                

                <select onchange="rows_per_page();" name="rows_per_page" id="rows_per_page">
                    <!-- <option value="1" @selected($per_page=="1" )>1</option>
                    <option value="2" @selected($per_page=="2" )>2</option> -->
                    <option value="10" @selected($per_page=="10" )>10</option>
                    <option value="20" @selected($per_page=="20" )>20</option>
                    <option value="30" @selected($per_page=="30" )>30</option>
                    <option value="50" @selected($per_page=="50" )>50</option>
                    <!-- <option value="all" @selected($per_page=="all" )>All</option> -->
                </select>
                <label for="rows_per_page" style="font-size: 18px;">: Rows</label>
                <!-- </form> -->
            </div>
            <div style="margin-top: 15px;">
                {{$spares->appends($filters)->links('pagination::custom')}}
            </div>
        </div>
    @endif

</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="/dist/frontend/js/jquery_local.js"></script>
<script src="/dist/frontend/js/jquery_form_local.js"></script>

<script>
    jQuery(document).ready(function() {
        <?php if ( $place=="workshop" ) {?>
        $('#workshop').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#workshop1').css('background', '#F7941D')
        <?php } ?>
    
        <?php if ( $place=="roll_stand" ) {?>
        $('#roll_stand').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#roll_stand1').css('background', '#F7941D')
        <?php } ?>
    
        <?php if ( $place=="spm" ) {?>
        $('#spm').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#spm1').css('background', '#F7941D')
        <?php } ?>
    
        <?php if ( $place == "os_mcl" ) {?>
        $('#os_mcl').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#os_mcl1').css('background', '#F7941D')
        <?php } ?>
    
        <?php if ( $place == "os_ccl" ) {?>
        $('#os_ccl').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#os_ccl1').css('background', '#F7941D')
        <?php } ?>
        
        <?php if ( $place == "mcl_exit" ) {?>
        $('#mcl_exit').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#mcl_exit1').css('background', '#F7941D')
        <?php } ?>

        <?php if ( $place == "jk_bay" ) {?>
        $('#jk_bay').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#jk_bay1').css('background', '#F7941D')
        <?php } ?>

        <?php if ( $place == "de_bay" ) {?>
        $('#de_bay').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#de_bay1').css('background', '#F7941D')
        <?php } ?>
        
        <?php if ( $place == "cd_bay" ) {?>
        $('#cd_bay').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#cd_bay1').css('background', '#F7941D')
        <?php } ?>
    
    });
</script>
<script>
    function rows_per_page() {
        let per_page = document.getElementById('rows_per_page').value;
        let session_value =
            `{{http_build_query(\Session::get('filters'))}}`
    
        const parseResult = session_value.replaceAll('&amp;', '&');
    
        window.location.href =
            `/dashboard/spares?${parseResult}&rows_per_page=${per_page}`;
    }
</script>

<style>
.floating-button {
    position: fixed;
    bottom: 30px;
    right: 13px;
    z-index: 2;
}
</style>
<style>
    .maindiv {
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.25) inset;
        background-color: #F7F6F5;
        width: 100%;
        max-width: 415px;
        margin: auto;
        border-radius: 5px;
    
    }
    .button {
    background-color: transparent;
    border: none;
    border-radius: 5px;
    width: 100%;
    max-width: 415px;
    margin: auto;
    text-align: left;
    cursor: pointer;
    padding: 10px;
    color: black;
}
</style>
<script>
$(document).ready(function() {
    $(".scrollmenu").animate({
        scrollLeft: $(`#{{$place}}`).offset().left - 20
    }, 2000);
});
</script>
<style>
    div.scrollmenu {
    /* position: relative; */
    z-index: 5;
    background-color: white;
    overflow: auto;
    white-space: nowrap;
    margin-top: -25px;
    /* margin-left: 5px; */
    position: fixed;
    width: 100%;
    left: 0;

}

.scrollmenu a {
    display: inline-block;
    color: #0D1B2A;
    text-align: center;
    text-decoration: none;
    font-weight: 600;
    padding: 8px 10px;
    margin-bottom: 20px;
    background-color: #D9D9D9;
    border-radius: 10px;
    margin: 8px 4px 20px 4px;

}

</style>
@endsection