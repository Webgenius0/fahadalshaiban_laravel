<?php

use GPBMetadata\Google\Api\Auth;

$book = App\Models\Order::where('user_id', auth()->user()->id)->where('payment_status', 'booked')->count();
$totalActivesignages = App\Models\Signage::where('status', 'active')->count();

?>
@push('style')
<style>
    .btn-common {
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .btn-common:hover {
    color: gray; /* Change text color to gray on hover */
  }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.3.0/dist/fullcalendar.min.css" rel="stylesheet">
<style>
    .fc-event {
        background-color: yellow !important;
        color: black !important;
    }


    .fc-event {
        background-color: yellow !important;
        border-color: yellow !important;
        color: black !important;
    }

    .fc-day.fc-booked {
        background-color: yellow !important;
    }

    .fc-day.fc-today-success {
        background-color: rgb(161, 240, 180) !important;
        color: white !important;
    }

    .left-side,
    .right-side {
        display: flex;
        flex-direction: column;
    }

    .left-side div,
    .right-side div {
        margin-bottom: 10px;
        /* Adjust spacing as needed */
    }
</style>
@endpush
@extends('client.app', ['title' => 'Home'])
@section('content')
<div class="main-content">
    <section class="overview-cards-wrapper">
        <div class="overview-card">
            <h3 class="overview-card-title">{{__('userdashboard.activecampaigns')}}</h3>
            <div class="overview-card-content">
                <p class="overview-card-amount">{{$totalActivesignages}}</p>

                <div class="overview-card-icon card-icon-green">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="54"
                        height="51"
                        viewBox="0 0 54 51"
                        fill="none">
                        <path
                            d="M53.4543 20.6161C53.2795 21.1546 52.7799 21.4969 52.2429 21.4969C52.1124 21.4969 51.9796 21.4767 51.8489 21.4341L47.2156 19.9287C46.5464 19.7113 46.1801 18.9926 46.3975 18.3232C46.6148 17.654 47.3336 17.2877 48.003 17.5052L52.6364 19.0105C53.3055 19.2282 53.6718 19.9469 53.4543 20.6161ZM40.3136 7.78583C40.4029 7.80483 40.4919 7.81396 40.5798 7.81396C41.1685 7.81396 41.6974 7.40348 41.8248 6.80454L42.8378 2.03932C42.9841 1.35108 42.5448 0.67442 41.8564 0.528108C41.1683 0.381796 40.4916 0.821156 40.3452 1.5095L39.3322 6.27472C39.186 6.96296 39.6252 7.63952 40.3136 7.78583ZM47.3889 12.1974L51.5739 9.78121C52.1834 9.42934 52.3921 8.65011 52.0404 8.04065C51.6885 7.43109 50.9093 7.22235 50.2998 7.57422L46.1148 9.99038C45.5053 10.3422 45.2966 11.1215 45.6483 11.7309C45.7319 11.8759 45.8433 12.003 45.976 12.1049C46.1088 12.2068 46.2603 12.2816 46.4219 12.3249C46.5836 12.3682 46.7522 12.3792 46.9181 12.3573C47.084 12.3355 47.244 12.2811 47.3889 12.1974ZM44.7331 27.8627C45.2431 28.746 45.3779 29.7778 45.1127 30.7678C44.8473 31.7578 44.2147 32.584 43.3314 33.0939C42.7515 33.4297 42.0932 33.6064 41.423 33.6062C40.3746 33.6062 39.3493 33.1745 38.6155 32.3867C33.0063 32.9234 27.4103 34.4811 21.9482 37.0244L28.8681 43.9444C29.3658 44.442 29.3658 45.2486 28.8681 45.7463L24.4876 50.1269C24.2486 50.3658 23.9246 50.5 23.5867 50.5C23.2488 50.5 22.9247 50.3658 22.6858 50.1269L14.004 41.4452C12.8824 42.0033 11.6466 42.2937 10.3938 42.2933C7.57298 42.2933 4.82608 40.8306 3.3172 38.2172L1.09099 34.3613C-1.15741 30.4668 0.181688 25.4692 4.07604 23.2207L10.0038 19.7983C15.5729 16.1373 20.2074 11.7355 23.7891 6.70781C23.278 5.04063 23.962 3.17743 25.535 2.2693C27.3639 1.21369 29.7105 1.84247 30.7663 3.67105L34.8404 10.7277L35.175 10.5344C36.5167 9.75987 38.0842 9.55505 39.5889 9.95842C41.0937 10.3616 42.349 11.3226 43.1235 12.6642C43.8981 14.0059 44.1027 15.5735 43.6994 17.0781C43.2963 18.5828 42.3353 19.8382 40.9936 20.6127L40.6591 20.8059L44.7331 27.8627ZM36.1144 12.9347L39.3848 18.5992L39.7194 18.4061C40.4716 17.9718 41.0109 17.266 41.2379 16.4189C41.465 15.5717 41.3508 14.6908 40.9165 13.9386C40.4823 13.1864 39.7765 12.647 38.9293 12.42C38.0822 12.1931 37.2013 12.3073 36.4491 12.7414L36.1144 12.9347ZM12.3712 21.2775L20.2882 34.9901C25.7921 32.355 31.4386 30.6762 37.1154 29.9867L25.118 9.20647C21.6824 13.7778 17.4054 17.8285 12.3712 21.2775ZM13.1836 38.9956L18.0396 36.192L10.2062 22.624L5.35006 25.4276C2.67249 26.9737 1.75183 30.4097 3.29766 33.0874L5.52387 36.9433C7.06981 39.6207 10.506 40.5415 13.1836 38.9956ZM26.1653 44.8454L19.5704 38.2505L16.3008 40.1382L23.5867 47.4241L26.1653 44.8454ZM42.5263 29.1368L28.5593 4.94528C28.206 4.33338 27.4208 4.12294 26.8089 4.47629C26.197 4.82955 25.9867 5.61483 26.34 6.22673L40.3069 30.4182C40.6601 31.0301 41.4454 31.2404 42.0573 30.8872C42.3512 30.7175 42.5621 30.4409 42.6513 30.1083C42.7403 29.7758 42.696 29.4307 42.5263 29.1368Z"
                            fill="#245214" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="overview-card">
            <h3 class="overview-card-title">{{__('userdashboard.totalbooked')}}</h3>
            <div class="overview-card-content">
                <p class="overview-card-amount">{{$book}}</p>
                <div class="overview-card-icon card-icon-purple">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="50"
                        height="51"
                        viewBox="0 0 50 51"
                        fill="none">
                        <path
                            d="M38.8625 3.625H40.4008C40.608 3.625 40.8067 3.54269 40.9532 3.39618C41.0997 3.24966 41.182 3.05095 41.182 2.84375C41.182 2.63655 41.0997 2.43784 40.9532 2.29132C40.8067 2.14481 40.608 2.0625 40.4008 2.0625H35.7617C35.5545 2.0625 35.3558 2.14481 35.2093 2.29132C35.0628 2.43784 34.9805 2.63655 34.9805 2.84375C34.9805 3.05095 35.0628 3.24966 35.2093 3.39618C35.3558 3.54269 35.5545 3.625 35.7617 3.625H37.3V6.35938H30.1414V3.625H31.6797C31.8869 3.625 32.0856 3.54269 32.2321 3.39618C32.3786 3.24966 32.4609 3.05095 32.4609 2.84375C32.4609 2.63655 32.3786 2.43784 32.2321 2.29132C32.0856 2.14481 31.8869 2.0625 31.6797 2.0625H27.0414C26.8342 2.0625 26.6355 2.14481 26.489 2.29132C26.3425 2.43784 26.2602 2.63655 26.2602 2.84375C26.2602 3.05095 26.3425 3.24966 26.489 3.39618C26.6355 3.54269 26.8342 3.625 27.0414 3.625H28.5789V6.35938H21.4211V3.625H22.9586C23.1658 3.625 23.3645 3.54269 23.511 3.39618C23.6575 3.24966 23.7398 3.05095 23.7398 2.84375C23.7398 2.63655 23.6575 2.43784 23.511 2.29132C23.3645 2.14481 23.1658 2.0625 22.9586 2.0625H18.3203C18.1131 2.0625 17.9144 2.14481 17.7679 2.29132C17.6214 2.43784 17.5391 2.63655 17.5391 2.84375C17.5391 3.05095 17.6214 3.24966 17.7679 3.39618C17.9144 3.54269 18.1131 3.625 18.3203 3.625H19.8586V6.35938H12.7V3.625H14.2383C14.4455 3.625 14.6442 3.54269 14.7907 3.39618C14.9372 3.24966 15.0195 3.05095 15.0195 2.84375C15.0195 2.63655 14.9372 2.43784 14.7907 2.29132C14.6442 2.14481 14.4455 2.0625 14.2383 2.0625H9.59922C9.39202 2.0625 9.1933 2.14481 9.04679 2.29132C8.90028 2.43784 8.81797 2.63655 8.81797 2.84375C8.81797 3.05095 8.90028 3.24966 9.04679 3.39618C9.1933 3.54269 9.39202 3.625 9.59922 3.625H11.1375V6.35938H6.89062C5.13281 6.35938 3.71094 7.78125 3.71094 9.53906V30.9453C3.71094 32.7031 5.13281 34.125 6.89062 34.125H23.1484V47.375H26.8516V34.125H43.1094C44.8672 34.125 46.2891 32.7031 46.2891 30.9453V9.53906C46.2891 7.78125 44.8672 6.35938 43.1094 6.35938H38.8625V3.625ZM44.7266 9.53906V30.9453C44.7266 31.8359 44 32.5625 43.1094 32.5625H6.89062C6 32.5625 5.27344 31.8359 5.27344 30.9453V9.53906C5.27344 8.64844 6 7.92188 6.89062 7.92188H43.1094C44 7.92188 44.7266 8.64844 44.7266 9.53906Z"
                            fill="#1B0F57" />
                        <path
                            d="M9.02259 23.1333C9.17783 23.5159 9.44355 23.8437 9.78586 24.0747C10.1282 24.3056 10.5315 24.4294 10.9445 24.4302C11.1085 24.4302 11.2804 24.4067 11.4523 24.3599L12.9913 27.0552C13.1561 27.3501 13.3963 27.596 13.6873 27.7676C13.9783 27.9392 14.3097 28.0303 14.6476 28.0317C14.9757 28.0317 15.3038 27.9458 15.6007 27.7739C16.5148 27.2505 16.8351 26.0786 16.3116 25.1645L15.3038 23.3911L20.4288 23.6255H20.4991C20.9679 23.6255 21.4132 23.3989 21.6866 23.0083C21.9991 22.5708 22.0616 22.0083 21.8507 21.4927L21.1945 19.852C22.257 19.0942 22.7335 17.7895 22.2804 16.6567C21.8273 15.5239 20.5773 14.9145 19.2882 15.102L18.632 13.4692C18.5362 13.2192 18.3783 12.9977 18.1733 12.8255C17.9683 12.6533 17.7229 12.536 17.4601 12.4849C17.2211 12.4383 16.9742 12.4525 16.7422 12.5262C16.5101 12.5999 16.3003 12.7308 16.132 12.9067L11.7413 17.5161L9.37415 18.4614C8.85852 18.6645 8.46009 19.063 8.24134 19.563C8.0304 20.0708 8.02259 20.6333 8.22571 21.1411L9.02259 23.1333ZM14.8273 26.4145C14.7101 26.477 14.6085 26.4692 14.5538 26.4536C14.5103 26.4397 14.47 26.4174 14.4351 26.3879C14.4003 26.3584 14.3716 26.3223 14.3507 26.2817L12.9288 23.7973L13.5773 23.5317L14.9523 25.938C15.046 26.1099 14.9913 26.3208 14.8273 26.4145ZM17.1866 14.063L20.3898 22.063L14.4757 21.7895L13.1007 18.352L17.1866 14.063ZM26.2874 15.62H40.0734C40.2806 15.62 40.4793 15.5377 40.6258 15.3912C40.7723 15.2447 40.8546 15.046 40.8546 14.8388C40.8546 14.6316 40.7723 14.4328 40.6258 14.2863C40.4793 14.1398 40.2806 14.0575 40.0734 14.0575H26.2874C26.0802 14.0575 25.8815 14.1398 25.735 14.2863C25.5885 14.4328 25.5062 14.6316 25.5062 14.8388C25.5062 15.046 25.5885 15.2447 25.735 15.3912C25.8815 15.5377 26.0802 15.62 26.2874 15.62ZM26.2874 20.6942H40.0734C40.2806 20.6942 40.4793 20.6119 40.6258 20.4654C40.7723 20.3189 40.8546 20.1202 40.8546 19.913C40.8546 19.7058 40.7723 19.5071 40.6258 19.3605C40.4793 19.214 40.2806 19.1317 40.0734 19.1317H26.2874C26.0802 19.1317 25.8815 19.214 25.735 19.3605C25.5885 19.5071 25.5062 19.7058 25.5062 19.913C25.5062 20.1202 25.5885 20.3189 25.735 20.4654C25.8815 20.6119 26.0802 20.6942 26.2874 20.6942ZM26.2874 25.7684H40.0734C40.2806 25.7684 40.4793 25.6861 40.6258 25.5396C40.7723 25.3931 40.8546 25.1944 40.8546 24.9872C40.8546 24.78 40.7723 24.5813 40.6258 24.4348C40.4793 24.2883 40.2806 24.2059 40.0734 24.2059H26.2874C26.0802 24.2059 25.8815 24.2883 25.735 24.4348C25.5885 24.5813 25.5062 24.78 25.5062 24.9872C25.5062 25.1944 25.5885 25.3931 25.735 25.5396C25.8815 25.6861 26.0802 25.7684 26.2874 25.7684Z"
                            fill="#1B0F57" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="overview-card">
            <h3 class="overview-card-title">{{__('userdashboard.totalviewe')}}</h3>
            <div class="overview-card-content">
                <p class="overview-card-amount">1800000</p>
                <div class="overview-card-icon card-icon-orange">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="50"
                        height="51"
                        viewBox="0 0 50 51"
                        fill="none">
                        <path
                            d="M49.6821 24.5279C49.2354 23.9169 38.5926 9.56641 24.9997 9.56641C11.4068 9.56641 0.763467 23.9169 0.317275 24.5273C0.111103 24.8098 0 25.1505 0 25.5001C0 25.8498 0.111103 26.1905 0.317275 26.4729C0.763467 27.084 11.4068 41.4345 24.9997 41.4345C38.5926 41.4345 49.2354 27.0839 49.6821 26.4734C49.8886 26.1911 49.9998 25.8504 49.9998 25.5007C49.9998 25.1509 49.8886 24.8102 49.6821 24.5279ZM24.9997 38.1378C14.9871 38.1378 6.31513 28.6131 3.74804 25.4993C6.31181 22.3828 14.9656 12.8631 24.9997 12.8631C35.0118 12.8631 43.6832 22.3861 46.2514 25.5016C43.6876 28.618 35.0338 38.1378 24.9997 38.1378Z"
                            fill="#F04F0F" />
                        <path
                            d="M24.9995 15.6104C19.5462 15.6104 15.1094 20.0472 15.1094 25.5005C15.1094 30.9538 19.5462 35.3906 24.9995 35.3906C30.4528 35.3906 34.8896 30.9538 34.8896 25.5005C34.8896 20.0472 30.4528 15.6104 24.9995 15.6104ZM24.9995 32.0938C21.3638 32.0938 18.4062 29.1361 18.4062 25.5005C18.4062 21.8648 21.3639 18.9071 24.9995 18.9071C28.6352 18.9071 31.5929 21.8648 31.5929 25.5005C31.5929 29.1361 28.6353 32.0938 24.9995 32.0938Z"
                            fill="#F04F0F" />
                    </svg>
                </div>
            </div>
        </div>
        <!-- <div class="overview-card">
            <h3 class="overview-card-title">{{__('userdashboard.totalspending')}}</h3>
            <div class="overview-card-content">
                <p class="overview-card-amount">SR 2000</p>
                <div class="overview-card-icon card-icon-pink">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="50"
                        height="51"
                        viewBox="0 0 50 51"
                        fill="none">
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M14.1467 20.0779C13.0534 18.887 12.2901 17.4312 11.9325 15.8546H5.09463C4.53707 15.8584 4.00363 16.0825 3.61071 16.4781C3.21779 16.8737 2.99727 17.4087 2.99727 17.9663C2.99727 18.5238 3.21779 19.0588 3.61071 19.4544C4.00363 19.85 4.53707 20.0741 5.09463 20.0779H14.1467ZM32.7563 18.8388C32.7298 19.0008 32.6478 19.1486 32.5245 19.257C32.4011 19.3653 32.244 19.4276 32.0799 19.433C31.9158 19.4385 31.7549 19.3869 31.6246 19.287C31.4943 19.1871 31.4027 19.0451 31.3653 18.8853C31.1856 18.1213 31.096 17.3389 31.0984 16.554C31.099 16.3212 31.1075 16.0881 31.1237 15.8546H30.0643C29.7068 17.4312 28.9435 18.8871 27.8502 20.0779H36.197C36.2479 20.0773 36.2965 20.0568 36.3326 20.0207C36.3686 19.9847 36.3891 19.9361 36.3897 19.8852V16.0473C36.3891 15.9963 36.3686 15.9477 36.3326 15.9117C36.2965 15.8757 36.2479 15.8552 36.197 15.8545H34.2368C33.526 16.7258 33.0201 17.7456 32.7563 18.8387V18.8388ZM31.3244 14.4345C31.3404 14.3597 31.3574 14.2848 31.3752 14.2099C31.8859 12.0599 32.9779 10.0918 34.5318 8.52071C35.7854 7.27373 37.3094 6.37041 38.9867 6.00948L38.4687 4.28584C38.4294 4.15396 38.4293 4.0135 38.4684 3.88157C38.5075 3.74964 38.5842 3.63195 38.6891 3.54284C38.7939 3.45372 38.9225 3.39703 39.059 3.37968C39.1955 3.36233 39.3341 3.38507 39.4579 3.44512L47.9985 6.96172C48.0982 7.00275 48.1871 7.06597 48.2587 7.14657C48.3302 7.22717 48.3824 7.32302 48.4113 7.42683C48.4402 7.53064 48.445 7.63967 48.4254 7.74563C48.4058 7.85159 48.3623 7.95168 48.2981 8.03828C46.4634 10.4985 44.6478 12.977 42.8232 15.4453C42.7432 15.5528 42.6343 15.6353 42.5092 15.6834C42.3841 15.7315 42.2479 15.7431 42.1165 15.7169C41.985 15.6908 41.8637 15.6279 41.7666 15.5356C41.6694 15.4433 41.6004 15.3253 41.5676 15.1954L40.9766 12.8441C39.088 12.8585 37.2656 13.3995 35.7967 14.4189L35.7754 14.4338H36.1972C36.6248 14.4345 37.0347 14.6048 37.3371 14.9071C37.6395 15.2095 37.8097 15.6194 37.8104 16.0471V19.885C37.8104 19.9265 37.7781 20.0931 37.8186 20.0966C39.0355 20.207 40.1674 20.7677 40.9927 21.6688C41.818 22.5699 42.2772 23.7466 42.2805 24.9686V29.6513C42.7946 29.8637 43.2343 30.2236 43.5442 30.6855C43.8541 31.1474 44.0204 31.6907 44.0221 32.247V35.4573C44.0205 36.0136 43.8542 36.5569 43.5443 37.0189C43.2343 37.4808 42.7946 37.8406 42.2805 38.053V42.7359C42.2772 44.0321 41.7608 45.2741 40.8443 46.1906C39.9278 47.1071 38.6858 47.6235 37.3896 47.6268H6.45332C5.15724 47.6235 3.91519 47.1071 2.9987 46.1907C2.08222 45.2742 1.56585 44.0322 1.5625 42.7361V17.9662C1.56474 17.0301 1.9376 16.133 2.59951 15.4711C3.26143 14.8092 4.15854 14.4363 5.09463 14.4341H11.7255C11.7113 14.2246 11.7042 14.0133 11.7041 13.8003C11.7121 11.3404 12.6948 8.984 14.4371 7.24742C16.1793 5.51083 18.5389 4.5357 20.9988 4.5357C23.4587 4.5357 25.8183 5.51083 27.5605 7.24742C29.3027 8.984 30.2855 11.3404 30.2935 13.8003C30.2935 14.0133 30.2863 14.2246 30.2721 14.4341L31.3244 14.4345ZM32.7568 14.5376C32.66 14.9422 32.5914 15.3531 32.5518 15.7672C33.1919 14.7772 34.0211 13.9233 34.9919 13.2543C36.8389 11.9722 39.156 11.3427 41.5186 11.4379C41.6791 11.4348 41.8359 11.4862 41.9634 11.5838C42.0909 11.6813 42.1816 11.8193 42.2205 11.975L42.5772 13.3964L46.6202 7.92608L40.2562 5.30508L40.5784 6.37852H40.5776C40.6074 6.47841 40.6147 6.58362 40.5991 6.68667C40.5835 6.78972 40.5454 6.88806 40.4874 6.97468C40.4295 7.0613 40.3531 7.13407 40.2638 7.1878C40.1745 7.24154 40.0745 7.27491 39.9708 7.28555C38.3031 7.45655 36.7695 8.292 35.5303 9.52491C34.1638 10.9097 33.2043 12.6436 32.7568 14.537V14.5376ZM34.4258 31.6352C33.9127 31.6351 33.4154 31.813 33.0187 32.1385C32.622 32.464 32.3505 32.9169 32.2503 33.4202C32.1502 33.9234 32.2277 34.4459 32.4695 34.8984C32.7114 35.351 33.1027 35.7056 33.5767 35.902C34.0508 36.0984 34.5783 36.1244 35.0693 35.9754C35.5603 35.8265 35.9845 35.5119 36.2696 35.0853C36.5547 34.6586 36.683 34.1463 36.6328 33.6357C36.5825 33.125 36.3567 32.6476 35.9938 32.2848C35.7882 32.0785 35.5437 31.915 35.2746 31.8035C35.0055 31.692 34.7171 31.6348 34.4258 31.6352ZM34.9896 33.2891C34.8591 33.1586 34.6875 33.0773 34.5039 33.0592C34.3203 33.041 34.136 33.0871 33.9826 33.1896C33.8292 33.2921 33.716 33.4446 33.6624 33.6211C33.6088 33.7977 33.6181 33.9873 33.6887 34.1578C33.7593 34.3283 33.8868 34.469 34.0495 34.556C34.2122 34.643 34.4 34.6709 34.581 34.6349C34.7619 34.599 34.9248 34.5014 35.0419 34.3587C35.159 34.2161 35.2229 34.0373 35.2229 33.8528C35.2231 33.7481 35.2025 33.6444 35.1625 33.5477C35.1224 33.4509 35.0637 33.363 34.9896 33.2891ZM41.2157 30.8617H32.6933C32.3262 30.8633 31.9747 31.0098 31.7151 31.2693C31.4556 31.5289 31.3091 31.8804 31.3075 32.2475V35.4578C31.3091 35.8249 31.4556 36.1764 31.7151 36.436C31.9747 36.6955 32.3262 36.842 32.6933 36.8436H41.2157C41.5827 36.842 41.9343 36.6955 42.1938 36.4359C42.4533 36.1764 42.5998 35.8248 42.6014 35.4578V32.2472C42.5998 31.8801 42.4533 31.5286 42.1938 31.2691C41.9343 31.0095 41.5827 30.863 41.2157 30.8614V30.8617ZM32.6933 29.4412H40.8594V24.9688C40.8562 24.0493 40.4896 23.1685 39.8394 22.5184C39.1893 21.8682 38.3085 21.5016 37.3891 21.4984H5.09463C4.33298 21.4988 3.59185 21.2516 2.98301 20.7939V42.7361C2.9862 43.6555 3.35285 44.5364 4.00296 45.1865C4.65308 45.8366 5.53392 46.2033 6.45332 46.2064H37.3895C38.3088 46.2032 39.1895 45.8365 39.8396 45.1864C40.4896 44.5362 40.8562 43.6555 40.8594 42.7361V38.2641H32.6933C31.9495 38.2624 31.2367 37.9662 30.7108 37.4403C30.1848 36.9144 29.8887 36.2016 29.887 35.4578V32.2472C29.8887 31.5034 30.1848 30.7906 30.7108 30.2647C31.2367 29.7388 31.9495 29.4426 32.6933 29.4409V29.4412ZM25.756 20.0782H16.2409C14.9253 19.0817 13.9559 17.6971 13.4695 16.12C12.9831 14.5429 13.0042 12.8529 13.5298 11.2884C14.0555 9.72393 15.0592 8.36404 16.3992 7.40062C17.7393 6.43721 19.348 5.91894 20.9984 5.91894C22.6489 5.91894 24.2576 6.43721 25.5976 7.40062C26.9377 8.36404 27.9414 9.72393 28.467 11.2884C28.9927 12.8529 29.0138 14.5429 28.5274 16.12C28.0409 17.6971 27.0715 19.0817 25.756 20.0782ZM20.2882 8.55762V9.48262C19.7539 9.63702 19.2843 9.9608 18.95 10.4052C18.6157 10.8497 18.4348 11.3907 18.4346 11.9468C18.4346 13.7241 19.6313 14.1343 20.8108 14.5378C21.481 14.7673 22.1417 14.9935 22.1417 15.6539C22.1431 15.8049 22.1146 15.9548 22.0577 16.0947C22.0009 16.2346 21.9169 16.3619 21.8106 16.4692C21.7043 16.5765 21.5778 16.6617 21.4384 16.7198C21.299 16.7779 21.1494 16.8078 20.9984 16.8078C20.8474 16.8078 20.6978 16.7779 20.5584 16.7198C20.419 16.6617 20.2925 16.5765 20.1862 16.4692C20.0799 16.3619 19.9959 16.2346 19.9391 16.0947C19.8822 15.9548 19.8537 15.8049 19.8551 15.6539C19.8551 15.4655 19.7802 15.2849 19.647 15.1517C19.5139 15.0185 19.3332 14.9437 19.1448 14.9437C18.9565 14.9437 18.7758 15.0185 18.6426 15.1517C18.5094 15.2849 18.4346 15.4655 18.4346 15.6539C18.4349 16.21 18.6158 16.7508 18.9501 17.1952C19.2844 17.6395 19.754 17.9632 20.2882 18.1176V19.0426C20.2882 19.231 20.363 19.4116 20.4962 19.5448C20.6294 19.678 20.8101 19.7528 20.9984 19.7528C21.1868 19.7528 21.3675 19.678 21.5007 19.5448C21.6339 19.4116 21.7087 19.231 21.7087 19.0426V18.1176C22.2429 17.9632 22.7125 17.6394 23.0468 17.195C23.3811 16.7506 23.562 16.2096 23.5622 15.6535C23.5622 13.9807 22.4222 13.5904 21.2658 13.1946C20.5655 12.955 19.8551 12.7117 19.8551 11.9464C19.8537 11.7954 19.8822 11.6455 19.9391 11.5056C19.9959 11.3657 20.0799 11.2384 20.1862 11.1311C20.2925 11.0238 20.419 10.9386 20.5584 10.8805C20.6978 10.8224 20.8474 10.7925 20.9984 10.7925C21.1494 10.7925 21.299 10.8224 21.4384 10.8805C21.5778 10.9386 21.7043 11.0238 21.8106 11.1311C21.9169 11.2384 22.0009 11.3657 22.0577 11.5056C22.1146 11.6455 22.1431 11.7954 22.1417 11.9464C22.1417 12.1348 22.2165 12.3154 22.3497 12.4486C22.4829 12.5818 22.6636 12.6566 22.852 12.6566C23.0403 12.6566 23.221 12.5818 23.3542 12.4486C23.4874 12.3154 23.5622 12.1348 23.5622 11.9464C23.562 11.3904 23.3811 10.8495 23.0469 10.4052C22.7126 9.96085 22.2431 9.63712 21.709 9.48272V8.55762C21.709 8.36925 21.6342 8.18859 21.501 8.05539C21.3678 7.9222 21.1871 7.84737 20.9987 7.84737C20.8104 7.84737 20.6297 7.9222 20.4965 8.05539C20.3633 8.18859 20.2885 8.36925 20.2885 8.55762H20.2882Z"
                            fill="#5E0844" />
                    </svg>
                </div>
            </div>
        </div> -->
    </section>

    <!-- <div id="calendar"></div> -->

    <section class="campaign-wrapper">
        <div class="campaign-header">
            <div>
                <h4 class="campaign-header-title">{{__('userdashboard.campaign')}}</h4>
                <p class="campaign-subtitle">{{__('userdashboard.currentlist')}}</p>
            </div>

            <div class="campaign-state">
                <span class="campaign-active">Active</span>
                <span>Archived</span>
                <span>Draft</span>
            </div>
        </div>

        <div class="empty-campaign-banner">
            <div class="my-container">
                <div class="empty-campaign">
                    <h2>{{__('userdashboard.havenotcampaign')}}</h2>
                    <p>{{__('userdashboard.createfirst')}}</p>
                    <a href="{{ route('page.new.campaigns') }}" class="btn-common" style="text-decoration: none; ">
                        {{__('userdashboard.startnewcampaign')}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M4 12L20 12M20 12L14 18M20 12L14 6"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>


        <!-- Modal with FullCalendar -->
        <div class="modal fade" id="bookingScheduleModal" tabindex="-1" aria-labelledby="bookedDaysModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookedDaysModalLabel">Booked Dates</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- <div class="modal-body">
                        <div id="calendars"></div>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="campaign-list">
            @foreach($orders as $order)
            <article class="campaign-item ">
                @php
                $endDate = $order->end_date; 
                $today = \Carbon\Carbon::today(); 
                @endphp

                <div class="d-flex justify-content-end">
                    <span class="d-flex align-items-center">
                        @if (\Carbon\Carbon::parse($endDate)->isPast())
                        <!-- Red round icon for Campaign End -->

                        <strong style="color: red;">Campaign End</strong>
                        <i class="fa fa-circle" style="color: red; font-size: 18px; margin-left: 5px;"></i>
                        @elseif($order->payment_status == 'pending')
                        <!-- Orange round icon for Pending Campaign -->

                        <strong style="color:#FFA500;">Pending Campaign</strong>
                        <i class="fa fa-circle" style="color: #FFA500; font-size: 18px; margin-left: 5px;"></i>
                        @else

                        <!-- Green round icon for Live Campaign -->

                        <strong style="color: #34b26f;">Live Campaign</strong>
                        <i class="fa fa-circle d-flex justify-items-end" style=" color: #34b26f; font-size: 18px; margin-left: 5px;border-radius: 50%;"></i>
                        @endif
                    </span>
                </div>


                <!-- Billboard Image -->
                <img src="{{ asset($order->art_work ?? 'default/banner.png') }}" alt="Billboard" class="billboard-card-image" />
                <div>
                    <strong style="color: #198754;">Campaign Title: {{$order->ad_title}}</strong>
                </div>

                <div class="d-flex flex-column">
                    <!-- <div class="d-flex justify-content-between">
                        <strong>Start Date: {{ \Carbon\Carbon::parse($order->start_date)->format('M d, Y') }}</strong>

                        <strong><span style="color: red;">End Date:</span> {{ \Carbon\Carbon::parse($order->end_date)->format('M d, Y') }}</strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        @php
                        $startDate = \Carbon\Carbon::parse($order->start_date);
                        $endDate = \Carbon\Carbon::parse($order->end_date);
                        $totalDays = $startDate->diffInDays($endDate);
                        @endphp

                        @if($totalDays > 0)
                        <strong>Total Days: {{ $totalDays }}</strong>
                        @else
                        <strong>Total Days:0 </strong>
                        @endif

                        <strong>Total Price: {{ $order->per_day_price }} </strong>
                    </div>


                    <div class="d-flex justify-content-between">
                        @php
                        $dailyViews = $order->avg_daily_views*1000;

                        @endphp
                        <strong>Daily Views: {{ $dailyViews }} </strong>

                        <strong>Total Signage:{{$totalOrders}}</strong>
                    </div> -->

                    <div class="d-flex justify-content-between">
                        <div class="left-side">
                            <div><strong style="color: #34b26f;">Start Date:</strong> {{ \Carbon\Carbon::parse($order->start_date)->format('M d, Y') }}</div>
                            <div>
                                <strong>Total Days:</strong>
                                @php
                                $startDate = \Carbon\Carbon::parse($order->start_date);
                                $endDate = \Carbon\Carbon::parse($order->end_date);
                                $totalDays = $startDate->diffInDays($endDate);
                                @endphp
                                {{ $totalDays > 0 ? $totalDays : 0 }}
                            </div>
                            <div><strong>Daily Views:</strong> {{ $order->avg_daily_views * 1000 }}</div>
                        </div>
                        <div class="right-side">
                            <div><strong style="color: red;">End Date:</strong> {{ \Carbon\Carbon::parse($order->end_date)->format('M d, Y') }}</div>
                            @php
                            $startDate = \Carbon\Carbon::parse($order->start_date);
                            $endDate = \Carbon\Carbon::parse($order->end_date);
                            $TotalDays = $startDate->diffInDays($endDate);
                            $perDayPrice = $order->per_day_price;
                            $totalPrice = $perDayPrice * ($TotalDays > 0 ? $TotalDays : 1); // Ensure at least 1 day is calculated
                            @endphp
                            <div><strong>Total Price:</strong> {{ $totalPrice }} <img src="{{ asset('currency/realcurrency.png') }}" alt="" style="width: 15px; height: 15px;"></div>
                            <div><strong>Total Signage:</strong> {{ $totalOrders }}</div>
                        </div>
                    </div>

                    <!-- Button and Campaign Top Section -->
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <!-- Calendar Button -->
                        <!-- <button class="campaign-edit-btn btn btn-success" data-bs-toggle="modal" data-bs-target="#bookingScheduleModal" data-campaign-detail-id="{{ $order->id }}">
                        Calendar
                    </button> -->

                        <!-- Campaign Status Section -->
                        <!-- <div class="campaign-top" style="display: flex; justify-content: flex-end; align-items: center; width: 100%; padding: 0;">
                        <div id="chart1" style="margin-right: 10px;"></div>
                        <div>
                            @if(\Carbon\Carbon::parse($order->end_date)->isPast())
                            <span class="campaign-status bg-danger">Expired Date, Renew Again</span>
                            @elseif($order->status == 'pending')
                            <span class="campaign-end">Pending</span>
                            @else
                            <span class="campaign-status">On Going</span>
                            @endif
                        </div>
                    </div> -->
                    </div>

                    <!-- Campaign ID -->
                    <!-- <p class="campaign-id">#{{ $order->uuid }}</p> -->

                    <!-- Published Date -->
                    <!-- <p class="campaign-details">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 17 15" fill="none">
                        <path d="M15 2.2998L5 12.3098L2 9.3098" stroke="#737373" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Published on <span>{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</span>
                </p> -->

                    <!-- Campaign Bottom Section -->
                    <div class="campaign-bottom">
                        <!-- End Date -->
                        <!-- <div class="campaign-end">
                        Ending on <span>{{ \Carbon\Carbon::parse($order->end_date ?? '2023-01-01')->format('d F Y') }}</span>
                    </div> -->

                        <!-- Payment Button (Conditional) -->
                        <!-- @if($order->status == 'pending')
                        <a href="{{ route('page.billing') }}" class="btn btn-success mt-1">
                            Payment
                        </a>
                        @endif -->
                    </div>

                    <div class="campaign-bottom d-flex justify-content-center">
                        <!-- <button class="btn btn-success mt-1">Campaign Details</button> -->
                         <a href="{{ route('getBookingDetails' , ['id' => $order->order_id]) }}" class="btn btn-success mt-1" class="btn btn-success mt-1" > Campaign Details</a>
                    </div>
            </article>
            @endforeach
        </div>


        <div>
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </section>
</div>
@endsection

@push('script')
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.3.0/dist/fullcalendar.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // $(document).ready(function() {
    //     $('#calendars').fullCalendar({
    //         header: {
    //             left: 'prev,next today',
    //             center: 'title',
    //             right: 'month,agendaWeek,agendaDay'
    //         },
    //         defaultView: 'month',
    //         events: [],
    //         dayRender: function(date, cell) {

    //             if (date.isSame(moment(), 'day')) {
    //                 cell.addClass('fc-today-success');
    //             }
    //             var bookedDates = $('#calendars').fullCalendar('clientEvents');
    //             var isBooked = bookedDates.some(function(event) {
    //                 return event.start.isSame(date, 'day');
    //             });

    //             if (isBooked) {
    //                 cell.addClass('fc-booked');
    //             }
    //         }
    //     });

    // When the "View Booked Days" button is clicked
    $('.campaign-edit-btn').on('click', function() {
    var campaignDetailId = $(this).data('campaign-detail-id');
    $.ajax({
        url: '/get-booked-dates/' + campaignDetailId,
        method: 'GET',
        success: function(response) {
            var bookedDates = response.bookedDates;
            $('#calendars').fullCalendar('removeEvents');
            $('#calendars').fullCalendar('addEventSource', bookedDates);
            $('#calendars').fullCalendar('rerenderEvents');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching booked dates:', error);
        }
    });
    });
    
</script>
@endpush