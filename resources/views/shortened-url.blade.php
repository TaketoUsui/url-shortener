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
                    <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">
                        {{ $shortUrl }}
                        <button type="button" onclick="navigator.clipboard.writeText({{ $shortUrl }});" class="ml-4 inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-tight">
                            コピー
                        </button>
                    </p>
                </div>
                <button type="button" onclick="location.href='{{ route('index') }}'" class="mb-2 inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">他のURLを短縮する</button>
            </div>
        </div>
    </main>
</div>
</body>
</html>
