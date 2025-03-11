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

                <form id="url-shortener" class="mt-6 mb-2" action="{{ route('create-url') }}" method="POST">
                    @csrf
                    <div>
                        <label for="long-url" class="mb-3">短縮したいURLを入力してください</label><br>
                        @error('long-url')
                            <input type="text" value="{{ old('long-url') }}" id="long-url" name="long-url" placeholder="https://example.com/" class="mb-0 bg-neutral-50 border text-neutral-900 text-sm rounded-lg focus:ring-neutral-500 focus:border-neutral-500 block w-full p-2.5 dark:bg-neutral-700 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-neutral-500 dark:focus:border-neutral-500 form-control border-red-500">
                            <div class="mb-2 text-red-300">「{{ old('long-url') }}」は正しいURLではありません</div>
                        @else
                            <input type="text" id="long-url" name="long-url" placeholder="https://example.com/" class="mb-2 bg-neutral-50 border text-neutral-900 text-sm rounded-lg focus:ring-neutral-500 focus:border-neutral-500 block w-full p-2.5 dark:bg-neutral-700 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-neutral-500 dark:focus:border-neutral-500 form-control border-neutral-300 dark:border-neutral-600">
                        @enderror
                    </div>
                    <button type="submit" class="mb-2 inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">作成</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
