@extends('layout.app') @section('content')
<div
    class="container-fluid"
    style="
        padding-right: var(--bs-gutter-x, 0rem);
        padding-left: var(--bs-gutter-x, 0rem);
    "
>
    <div class="container text-center">
        <br />
        <!-- <br> -->
        <div class="mt-2"></div>
        <a href="/add_maintenance">
            <div class="floating-button">
                <svg
                    width="79"
                    height="78"
                    viewBox="0 0 79 78"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g clip-path="url(#clip0_24_2)">
                        <g filter="url(#filter0_d_24_2)">
                            <path
                                d="M32 0C14.3264 0 0 14.3264 0 32C0 49.6736 14.3264 64 32 64C49.6736 64 64 49.6736 64 32C64 14.3264 49.6736 0 32 0ZM48 35.2H35.2V48H28.8V35.2H16V28.8H28.8V16H35.2V28.8H48V35.2Z"
                                fill="url(#paint0_linear_24_2)"
                            />
                        </g>
                        <path
                            d="M35.2001 16H28.8V48H35.2001V16Z"
                            fill="#F7F6F5"
                        />
                        <path d="M48 28.8H16V35.2001H48V28.8Z" fill="#F7F6F5" />
                    </g>
                    <defs>
                        <filter
                            id="filter0_d_24_2"
                            x="0"
                            y="0"
                            width="79"
                            height="78"
                            filterUnits="userSpaceOnUse"
                            color-interpolation-filters="sRGB"
                        >
                            <feFlood
                                flood-opacity="0"
                                result="BackgroundImageFix"
                            />
                            <feColorMatrix
                                in="SourceAlpha"
                                type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                result="hardAlpha"
                            />
                            <feOffset dx="9" dy="8" />
                            <feGaussianBlur stdDeviation="3" />
                            <feComposite in2="hardAlpha" operator="out" />
                            <feColorMatrix
                                type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                            />
                            <feBlend
                                mode="normal"
                                in2="BackgroundImageFix"
                                result="effect1_dropShadow_24_2"
                            />
                            <feBlend
                                mode="normal"
                                in="SourceGraphic"
                                in2="effect1_dropShadow_24_2"
                                result="shape"
                            />
                        </filter>
                        <linearGradient
                            id="paint0_linear_24_2"
                            x1="60.5"
                            y1="47.5"
                            x2="5"
                            y2="12"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#1F7FEA" stop-opacity="0.5" />
                            <stop offset="1" stop-color="#01EAFE" />
                        </linearGradient>
                        <clipPath id="clip0_24_2">
                            <rect width="79" height="78" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </div>
        </a>

        @if(count($maintenances)>0) @foreach($maintenances as $maintenance)
        <div style="margin-bottom: 20px" class="maindiv">
            <form action="/maintenance/{{$maintenance->id}}">
                <button type="submit" class="button">
                    @if(!$maintenance->maintenance_completed)
                    <div class="status">
                        <p
                            class="card-text text"
                            style="
                                color: white;
                                font-weight: bold;
                                font-size: 15px;
                                width: 90px;
                            "
                        >
                            Pending
                        </p>
                    </div>
                    @else
                    <div class="status1">
                        <p
                            class="card-text text"
                            style="
                                color: white;
                                font-weight: bold;
                                font-size: 15px;
                                width: 90px;
                            "
                        >
                            Completed
                        </p>
                    </div>
                    @endif
                    <div
                        style="
                            display: flex;
                            justify-content: left;
                            gap: 4%;
                            flex-wrap: wrap;
                            align-items: safe;
                        "
                    >
                        @php $media_display=null; if($maintenance->machine_id) {
                        $alt_name = $maintenance->machine->machine_name;
                        foreach($maintenance->machine->medias as $media) {
                        if($media->for_status == 'defect') { $media_display =
                        $media; break; } } if(!$media_display) { $media_display
                        = $maintenance->machine->medias[0]; } }
                        elseif($maintenance->spare_id) { $alt_name =
                        $maintenance->spare->spare_name;
                        foreach($maintenance->spare->medias as $media) {
                        if($media->for_status == 'defect') { $media_display =
                        $media; break; } } if(!$media_display) { $media_display
                        = $maintenance->spare->medias[0]; } } @endphp
                        <div style="width: 45%">
                            <img
                                style="border-radius: 6px"
                                src="@if($media_display){{$media_display->thumbnail_path}}@endif"
                                alt="{{ $alt_name }} image"
                                srcset=""
                                width="95%"
                            />
                        </div>
                        <div style="word-wrap: normal; width: 48%">
                            <div style="word-wrap: break-word; margin: 5px 0px">
                                <span style="font-weight: 600; font-size: 18px">
                                    Id: @if($maintenance->machine &&
                                    $maintenance->machine->machine_id){{$maintenance->machine->machine_id}}
                                    @elseif($maintenance->spare &&
                                    $maintenance->spare->spare_id){{$maintenance->spare->spare_id}}
                                    @else Not Available @endif</span
                                >
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px">
                                <span style="font-weight: 500; font-size: 16px">
                                    Name: @if($maintenance->machine &&
                                    $maintenance->machine->machine_name){{$maintenance->machine->machine_name}}
                                    @elseif($maintenance->spare &&
                                    $maintenance->spare->spare_name){{$maintenance->spare->spare_name}}
                                    @else Not Available @endif</span
                                >
                            </div>
                            @php if($maintenance->machine &&
                            $maintenance->machine->department) { $department =
                            $maintenance->machine->department; }
                            elseif($maintenance->spare &&
                            $maintenance->spare->department) { $department =
                            $maintenance->spare->department; } @endphp
                            <div style="word-wrap: break-word; margin: 5px 0px">
                                <span style="font-weight: 500; font-size: 16px">
                                    Department: @if($department && $department
                                    == 'mcl') MCL @elseif($department &&
                                    $department == 'ccl') CCL
                                    @elseif($department && $department ==
                                    'mechanical_maintenance') Mechanical
                                    Maintenance @else Not Available @endif</span
                                >
                            </div>

                            <div style="word-wrap: break-word; margin: 5px 0px">
                                <span style="font-weight: 500; font-size: 16px">
                                    Date:
                                    {{$maintenance->created_at->format('d-m-y')}}</span
                                >
                            </div>

                            <div style="word-wrap: break-word; margin: 5px 0px">
                                <span style="font-weight: 500; font-size: 16px">
                                    Time:
                                    {{$maintenance->created_at->format('h:i A')}}</span
                                >
                            </div>
                        </div>
                    </div>
                    <div
                        style="width: 90%; word-wrap: break-word; margin: 10px"
                    >
                        <span style="margin-right: 5px">Defect :</span>
                        <span style="color: #f72c1d">
                            @if($maintenance->defect)
                            {{$maintenance->defect}}
                            @else Not Available @endif
                        </span>
                    </div>
                </button>
            </form>
        </div>
        @endforeach @else
        <h5 style="margin: 20px auto; color: #f72c1d">No Maintenance Record Found</h5>
        @endif
    </div>

    @if($maintenances_count > $per_page)
    <br />
    <div
        class="pagination-wrapper"
        style="width: 100%; max-width: 415px; margin: auto"
    >
        <div
            style="
                display: flex;
                justify-content: left;
                align-items: center;
                margin-bottom: -8px;
            "
        >
            <select
                onchange="rows_per_page();"
                name="rows_per_page"
                id="rows_per_page"
            >
                <option value="10" @selected($per_page=="10" )>10</option>
                <option value="20" @selected($per_page=="20" )>20</option>
                <option value="30" @selected($per_page=="30" )>30</option>
                <option value="50" @selected($per_page=="50" )>50</option>
                <!-- <option value="all" @selected($per_page=="all" )>All</option> -->
            </select>
            <label for="rows_per_page" style="font-size: 18px">: Rows</label>
            <!-- </form> -->
        </div>
        <div style="margin-top: 15px">
            {{$maintenances->appends($filters)->links('pagination::custom')}}
        </div>
    </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="/dist/frontend/js/jquery_local.js"></script>
<script src="/dist/frontend/js/jquery_form_local.js"></script>
<script>
    function rows_per_page() {
        let per_page = document.getElementById("rows_per_page").value;
        let session_value = `{{http_build_query(\Session::get('filters'))}}`;

        const parseResult = session_value.replaceAll("&amp;", "&");

        window.location.href = `/dashboard/maintenance/?${parseResult}&rows_per_page=${per_page}`;
    }
</script>

<style>
    .maindiv {
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.25) inset;
        background-color: #f7f6f5;
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
    .status {
        position: absolute;
        background-color: #f72c1d;
        border: none;
        border-radius: 5px;
        align-items: right;
        width: 90px;
        height: 22px;
        margin-left: -16px;
        margin-top: -18px;
        text-align: center;
        font-style: italic;
        box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px;
    }
    .status1 {
        position: absolute;
        background-color: #21b121;
        border: none;
        border-radius: 5px;
        align-items: right;
        width: 90px;
        height: 22px;
        margin-left: -16px;
        margin-top: -18px;
        text-align: center;
        font-style: italic;
        box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px;
    }
</style>
<style>
    .floating-button {
        position: fixed;
        bottom: 30px;
        right: 13px;
        z-index: 2;
    }
</style>
<style>
    div.scrollmenu {
        /* position: relative; */
        z-index: 5;
        background-color: white;
        overflow: auto;
        white-space: nowrap;
        margin-top: -20px;
        /* margin-left: 5px; */
        position: fixed;
        width: 100%;
        left: 0;
    }

    .scrollmenu a {
        display: inline-block;
        color: #0d1b2a;
        text-align: center;
        text-decoration: none;
        font-weight: 600;
        padding: 8px 10px;
        background-color: #d9d9d9;
        border-radius: 10px;
        margin: 8px 4px 8px 4px;
    }
</style>

@endsection