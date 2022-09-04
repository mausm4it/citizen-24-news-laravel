@php
$blockPosts = $posts->take(4);
@endphp
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<link href="https://fonts.maateen.me/bangla/font.css" rel="stylesheet">


<style>
@media screen and (max-width: 600px) {
    .dateX {
        visibility: hidden;

    }

}
</style>



<div class="sg-breaking-news">



    <div class="container">
        <div class="breaking-content d-flex">
            <span>সর্বশেষ সংবাদ</span>
            <div class="d-flex flex-grow-1 flex-fill justify-content-center ">

                <marquee class="marqueeX" class="news-scroll" behavior="scroll" direction="left"
                    onmouseover="this.stop();" onmouseout="this.start();">
                    @foreach($breakingNewss as $post)
                    <i class='fas fa-bowling-ball ml-2 mt-2'></i> <a
                        href="{{ route('article.detail', ['id' => $post->slug]) }}">{!!
                        \Illuminate\Support\Str::limit($post->title, 100) !!}</a>
                    @endforeach
                </marquee>
                <span style="font-family: 'Bangla', sans-serif;
            font-size: 13px;" class="dateX" id="demo"
                    class="d-flex flex-grow-1 flex-fill justify-content-center "></span>
                <div id="app" style="" class="d-flex  justify-content-center  ">
                    <p class="mr-1 bangladate" d-text="dateBd.date"></p>
                    <p class="mr-1 bangladate" d-text="dateBd.month"></p>
                    <p d-text="dateBd.year" class="bangladate"></p>


                    <div>
                        <script>
                        const event = new Date();
                        const options = {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };







                        document.getElementById('demo').innerHTML = event.toLocaleDateString('bn-BD', options);
                        console.log(event.toLocaleDateString('bn-BD', options));
                        </script>



                    </div>
                </div>
            </div>
        </div>










    </div>




    <div class="breaking ">


        <div class="sg-home-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="post-slider">
                            @foreach($sliderPosts as $post)
                            <div class="sg-post featured-post">
                                @include('site.partials.home.primary.slider')
                                <div class="entry-content absolute">
                                    <div class="category">
                                        <ul class="global-list">
                                            @isset($post['category']->category_name)
                                            <li>
                                                <a
                                                    href="{{ url('category',$post['category']->slug) }}">{{ $post['category']->category_name }}</a>
                                            </li>
                                            @endisset
                                        </ul>
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{ route('article.detail', ['id' => $post->slug]) }}">{!!
                                            \Illuminate\Support\Str::limit($post->title, 50) !!}</a>
                                    </h2>
                                    <div class="entry-meta">
                                        <ul class="global-list">
                                            <li>{{ __('post_by') }} <a
                                                    href="{{ route('site.author',['id' => $post['user']->id]) }}">{{ data_get($post, 'user.first_name') }}</a>
                                            </li>
                                            <li><a
                                                    href="{{route('article.date', date('Y-m-d', strtotime($post->updated_at)))}}">{{ $post->updated_at->format('F j, Y') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            {{--  @php dd($blockPosts); @endphp --}}
                            @foreach($blockPosts as $post)
                            <div class="col-md-6">
                                <div class="sg-post">
                                    <div class="entry-header">
                                        <div class="entry-thumbnail">
                                            <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                                @if(isFileExist(@$post['image'], $result =
                                                @$post['image']->medium_image))
                                                <img src="{{ safari_check() ? basePath(@$post['image']).'/'.$result : static_asset('default-image/default-358x215.png')  }} "
                                                    data-original=" {{basePath(@$post['image'])}}/{{ $result }} "
                                                    class="img-fluid lazy" alt="{!! $post->title !!}">
                                                @else
                                                <img src="{{ static_asset('default-image/default-358x215.png') }} "
                                                    class="img-fluid" alt="{!! $post->title !!}">
                                                @endif
                                            </a>
                                        </div>
                                        @if($post->post_type=="video")
                                        <div class="video-icon block">
                                            <img src="{{static_asset('default-image/video-icon.svg') }} "
                                                alt="video-icon">
                                        </div>
                                        @elseif($post->post_type=="audio")
                                        <div class="video-icon block">
                                            <img src="{{static_asset('default-image/audio-icon.svg') }} "
                                                alt="audio-icon">
                                        </div>
                                        @endif
                                        <div class="category">
                                            <ul class="global-list">
                                                @isset($post->category->category_name)
                                                <li>
                                                    <a
                                                        href="{{ url('category',$post['category']->slug) }}">{{ $post['category']->category_name }}</a>
                                                </li>
                                                @endisset



                                            </ul>

                                            <a class="text-light"
                                                href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                                <p>{!! \Illuminate\Support\Str::limit($post->title, 40) !!}</p>
                                            </a>

                                        </div>
                                    </div>


                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--timeDatebangla -->
    <script>
    function getDatebd(arg) {
        const rojAdd = ' রোজ ';
        const esheAdd = {
            e: ' ',
            she: ''
        }
        const kalAdd = ' কাল';
        const abodo = '';
        const monthName = [
            'বৈশাখ', //0
            'জ্যৈষ্ঠ ', //1
            'আষাঢ় ', //2
            'শ্রাবণ ', //3
            'ভাদ্র', //4
            'আশ্বিন ', //5
            'কার্তিক ', //6
            'অগ্রহায়ণ ', //7
            'পৌষ ', //8
            'মাঘ', //9
            'ফাল্গুন ', //10
            'চৈত্র ' //11
        ];
        const dayName = [
            'বৃহস্পতিবার',
            'শুক্রবার',
            'শনিবার',
            'রবিবার',
            'সোমবার',
            'মঙ্গলবার',
            'বুধবার',

        ];
        const session = [
            'গ্রীষ্ম',
            'বর্ষা',
            'শরৎ',
            'হেমন্ত',
            'শীত',
            'বসন্ত',
        ];
        const numBd = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        const convertNumber = (n) => n.toString().split("").map(num => numBd[num]).join('');
        const addEe = n => {
            let x, y;
            x = n >= 10 && n < 20 ? esheAdd.e : '';
            y = n >= 20 && n <= 31 ? esheAdd.she : '';
            return x || y ? y + x : ''
        }



        const getYear = (dmy) => dmy.month <= 4 && dmy.date <= 13 ? dmy.year - 594 : dmy.year - 593;
        const getMonthDate = (d, m) => {
            switch (true) {
                case m == 1 && d <= 13:
                    m = 8;
                    d = d + 17;
                    break;
                case m == 1 && d > 13:
                    m = 9;
                    d = d - 13;
                    break;
                case m == 2 && d <= 12:
                    m = 9;
                    d = d + 18;
                    break;
                case m == 2 && d > 12:
                    m = 10;
                    d = d - 12;
                    break;
                case m == 3 && d <= 14:
                    m = 10;
                    d = d + 16;
                    break;
                case m == 3 && d > 14:
                    m = 11;
                    d = d - 14;
                    break;
                case m == 4 && d <= 13:
                    m = 11;
                    d = d + 17;
                    break;
                case m == 4 && d > 13:
                    m = 0;
                    d = d - 13;
                    break;
                case m == 5 && d <= 14:
                    m = 0;
                    d = d + 17;
                    break;
                case m == 5 && d > 14:
                    m = 1;
                    d = d - 14;
                    break;
                case m == 6 && d <= 14:
                    m = 1;
                    d = d + 17;
                    break;
                case m == 6 && d > 14:
                    m = 2;
                    d = d - 14;
                    break;
                case m == 7 && d <= 15:
                    m = 2;
                    d = d + 16;
                    break;
                case m == 7 && d > 15:
                    m = 3;
                    d = d - 15;
                    break;
                case m == 8 && d <= 15:
                    m = 3;
                    d = d + 16;
                    break;
                case m == 8 && d > 15:
                    m = 4;
                    d = d - 15;
                    break;
                case m == 9 && d <= 15:
                    m = 4;
                    d = d + 16;
                    break;
                case m == 9 && d > 15:
                    m = 5;
                    d = d - 15;
                    break;
                case m == 10 && d <= 15:
                    m = 5;
                    d = d + 15;
                    break;
                case m == 10 && d > 15:
                    m = 6;
                    d = d - 15;
                    break;
                case m == 11 && d <= 14:
                    m = 6;
                    d = d + 16;
                    break;
                case m == 11 && d > 14:
                    m = 7;
                    d = d - 14;
                    break;
                case m == 12 && d <= 14:
                    m = 7;
                    d = d + 16;
                    break;
                case m == 12 && d > 14:
                    m = 8;
                    d = d - 14;
                default:
                    m = false,
                        d = false;
            }

            return {
                month: m,
                date: d
            };

        }

        var GetdayName = dayName[new Date(arg.year, arg.month, arg.date).getDay()];
        let daymon = getMonthDate(arg.date, arg.month);
        let getSession = session[Math.floor(daymon.month / 2)];

        return {
            day: rojAdd + GetdayName,
            date: convertNumber(daymon.date) + addEe(daymon.date),
            month: monthName[daymon.month],
            session: getSession + kalAdd,
            year: convertNumber(getYear(arg)) + abodo,
        }

    }


    const setDateEng = (tarik) => {
        let dayName = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        let monthName = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
            "October", "November", "December"
        ]
        const arg = {
            date: tarik.getDate(),
            month: tarik.getMonth() + 1,
            year: tarik.getFullYear(),
        }
        console.log(arg)
        const dateEn = {
            day: dayName[tarik.getDay()],
            date: arg.date,
            month: monthName[arg.month - 1],
            year: arg.year
        }

        const dateBd = getDatebd(arg);
        return {
            dateEn,
            dateBd
        }
    }


    function setDatetimeHtml(dateVal) {
        let {
            dateEn,
            dateBd
        } = setDateEng(new Date(dateVal))
        console.log({
            dateEn,
            dateBd
        })
        const app = document.getElementById('app');
        const dtext = app.querySelectorAll('[d-text]');
        for (let i = 0; i < dtext.length; i++) {
            let att = dtext[i].getAttribute('d-text');
            if (att) {
                dtext[i].textContent = eval(att);
            }
        }



    }


    setDatetimeHtml(new Date());
    flatpickr("#indate");
    document.getElementById('indate').onchange = function() {
        setDatetimeHtml(this.value);

    }
    </script>