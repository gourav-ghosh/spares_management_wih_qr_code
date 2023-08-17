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
        <a href="/add_tool">
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
        @if(count($tools)>0) @foreach($tools as $tool)
        <div style="margin-bottom: 20px" class="maindiv">
            <form action="/tool/{{$tool->id}}">
                <button type="submit" class="button">
                    <div
                        style="
                            display: flex;
                            justify-content: left;
                            gap: 4%;
                            flex-wrap: wrap;
                            align-items: safe;
                        "
                    >
                        <div style="width: 45%">
                            <img
                                style="border-radius: 6px"
                                @if(count($tool->medias)>0) src="{{$tool->medias[0]->thumbnail_path
                            }}" @endif alt="{{$tool->tool_name}} image"
                            srcset="" width="95%">
                        </div>
                        <div style="word-wrap: normal; width: 48%">
                            <div style="word-wrap: break-word; margin: 5px 0px">
                                <span style="font-weight: 600; font-size: 18px">
                                    Id: @if($tool->tool_id){{$tool->tool_id}}
                                    @else Not Available @endif</span
                                >
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px">
                                <span style="font-weight: 500; font-size: 16px">
                                    Name: @if($tool->tool_name){{$tool->tool_name}}
                                    @else Not Available @endif</span
                                >
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px">
                                <span style="font-weight: 500; font-size: 16px">
                                    Machine: @if($tool->machine)
                                    {{$tool->machine}} @else Not Available
                                    @endif</span
                                >
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px">
                                <span style="font-weight: 500; font-size: 16px">
                                    Status: @if($tool->safety_status ==
                                    'unsafe')
                                    <span>
                                        <svg
                                            width="50"
                                            height="26"
                                            viewBox="0 0 28 26"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g clip-path="url(#clip0_39_1906)">
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M23.4318 17.7122L23.5664 8.28119L7.98151 8.27519L2.83381 12.9887L7.84689 17.7062L23.4318 17.7122ZM24.4071 19.5723L7.40535 19.5658C7.13967 19.5657 6.88622 19.4676 6.70084 19.2931L1.39823 14.3032C0.626162 13.5767 0.642924 12.3991 1.43578 11.6731L6.8808 6.68735C7.07116 6.51304 7.32745 6.41517 7.5931 6.41527L24.5948 6.42183C25.1481 6.42205 25.5907 6.83856 25.5834 7.35209L25.4222 18.6428C25.4149 19.1564 24.9604 19.5726 24.4071 19.5723ZM9.93664 11.6764C10.7088 12.403 10.6919 13.5805 9.89909 14.3065C9.10624 15.0325 7.8376 15.032 7.06547 14.3054C6.2934 13.5789 6.31017 12.4013 7.10302 11.6753C7.89587 10.9493 9.16457 10.9499 9.93664 11.6764Z"
                                                    fill="#FD441B"
                                                />
                                                <path
                                                    d="M21 10.6L13 15.4M17 13L21 15.4M13 10.6L15 11.8"
                                                    stroke="#FD441B"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_39_1906">
                                                    <rect
                                                        width="26"
                                                        height="28"
                                                        fill="white"
                                                        transform="matrix(0 -1 1 0 0 26)"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    <span>Reject</span>
                                    @else
                                    <span>
                                        <svg
                                            width="50"
                                            height="26"
                                            viewBox="0 0 28 26"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g clip-path="url(#clip0_39_1906)">
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M23.4318 17.7122L23.5664 8.28119L7.98151 8.27519L2.83381 12.9887L7.84689 17.7062L23.4318 17.7122ZM24.4071 19.5723L7.40535 19.5658C7.13967 19.5657 6.88622 19.4676 6.70084 19.2931L1.39823 14.3032C0.626162 13.5767 0.642924 12.3991 1.43578 11.6731L6.8808 6.68735C7.07116 6.51304 7.32745 6.41517 7.5931 6.41527L24.5948 6.42183C25.1481 6.42205 25.5907 6.83856 25.5834 7.35209L25.4222 18.6428C25.4149 19.1564 24.9604 19.5726 24.4071 19.5723ZM9.93664 11.6764C10.7088 12.403 10.6919 13.5805 9.89909 14.3065C9.10624 15.0325 7.8376 15.032 7.06547 14.3054C6.2934 13.5789 6.31017 12.4013 7.10302 11.6753C7.89587 10.9493 9.16457 10.9499 9.93664 11.6764Z"
                                                    fill="#56FD1B"
                                                />
                                                <path
                                                    d="M12 13.0769L14 15M16.8 11.9231L18.8 10M15.2 13.0769L17.2 15L22 10"
                                                    stroke="#56FD1B"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_39_1906">
                                                    <rect
                                                        width="26"
                                                        height="28"
                                                        fill="white"
                                                        transform="matrix(0 -1 1 0 0 26)"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    <span>Safe</span>

                                    @endif</span
                                >
                            </div>
                        </div>
                    </div>
                    <div
                        style="width: 90%; word-wrap: break-word; margin: 10px"
                    >
                        <span style="margin-right: 5px">Description :</span>
                        @if($tool->specification)
                        {{$tool->specification}}
                        @else Not Available @endif
                    </div>
                </button>
            </form>
        </div>
        @endforeach @else
        <h5 style="margin: 20px auto; color: #f72c1d">No tools Found</h5>
        @endif
    </div>

    @if($tools_count > $per_page)
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
                <!-- <option value="1" @selected($per_page=="1" )>1</option>
                    <option value="2" @selected($per_page=="2" )>2</option> -->
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
            {{$tools->appends($filters)->links('pagination::custom')}}
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

        window.location.href = `/dashboard/tools?${parseResult}&rows_per_page=${per_page}`;
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
        background-color: #f7f6f5;
        width: 100%;
        max-width: 415px;
        margin: auto;
        border-radius: 5px;
    }
    .button {
        background-color: trantoolnt;
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
        margin-bottom: 20px;
        background-color: #d9d9d9;
        border-radius: 10px;
        margin: 8px 4px 20px 4px;
    }
</style>
@endsection
