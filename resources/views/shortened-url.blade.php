<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>たんちゃん　URL短縮サービス</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main>
            <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                <h1 class="mb-1 font-medium">URL短縮ツール　たんちゃん</h1>
                <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">「たんちゃん」は、ブラウザ上で、長いURLを簡単に短縮できるツールです。</p>

                <div class="mt-6 mb-2">
                    <div class="mb-6">
                        <h2 class="mb-2">短縮前のURL</h2>
                        <a href="{{ $shortUrl }}" class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">{{ $longUrl }}</a>
                    </div>
                    <div class="mb-6">
                        <h2 class="mb-2">短縮後のURL</h2>
                        <p class="text-[#706f6c] dark:text-[#A1A09A]">
                            {{ $shortUrl }}
                            <button type="button" onclick="copyText(`{{ $shortUrl }}`)" class="ml-2 inline-block text-neutral-900 dark:text-neutral-400 hover:bg-neutral-100 dark:bg-neutral-800 dark:border-neutral-600 dark:hover:bg-neutral-700 items-center justify-center bg-white border-neutral-200 border h-8 rounded-sm text-sm p-2 leading-tight">
                                <span id="copy">
                                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                        <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                                    </svg>
{{--                                    <span class="px-2">Copy</span>--}}
                                </span>
                                <span id="copied" hidden>
                                    <svg class="w-3.5 h-3.5 text-blue-700 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                    </svg>
{{--                                    <span>Copied!</span>--}}
                                </span>
                            </button>
                            <button onclick="location.href='{{ route('getQRCode', $shortUrl_id) }}'" class="ml-1 inline-block text-neutral-900 dark:text-neutral-400 hover:bg-neutral-100 dark:bg-neutral-800 dark:border-neutral-600 dark:hover:bg-neutral-700 items-center justify-center bg-white border-neutral-200 border h-8 rounded-sm text-sm p-2 leading-tight">
                                <span id="download">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                      <path d="M2 2h2v2H2z"/>
                                      <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                      <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                      <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                                      <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"/>
                                    </svg>
                                </span>
                                <span id="downloaded" hidden>
                                    <svg class="w-3.5 h-3.5 text-blue-700 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                    </svg>
                                </span>
                            </button>
                        </p>
                    </div>
                    <button type="button" onclick="location.href='{{ route('index') }}'" class="mb-2 inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-3 py-1 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">他のURLを短縮する</button>
                </div>
            </div>
        </main>
    </div>
    <script>
        let copyText = function(text){
            navigator.clipboard.writeText(text).then(
                () => {
                    console.log('success')
                    $('#copy').prop('hidden', true)
                    $('#copied').prop('hidden', false)
                    setTimeout(() => {
                        $('#copy').prop('hidden', false)
                        $('#copied').prop('hidden', true)
                    }, 2000)
                },
            )
            console.log('fin')
        }
    </script>
</body>
</html>
