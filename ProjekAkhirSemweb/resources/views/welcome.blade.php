<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamus Jawa Kuno Indonesia</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9F6F1;
        }
        .font-dancing-script {
            font-family: 'Dancing Script', cursive;
        }
    </style>
</head>
<body class="text-stone-800 antialiased bg-gradient-to-b from-[#F9F6F1] to-amber-100 via-amber-50  min-h-screen">

    <!-- Main Container -->
    <div class="container mx-auto p-4 md:p-8 w-full">

        <!-- Main Content Card -->
        <div class="bg-white/50 backdrop-blur-sm rounded-2xl overflow-hidden">

            <!-- Header with Background Image -->
            <div class="relative h-64 md:h-80 w-full">
                <img src="/images/b402ddc63ebf742422134dcbd05c80cb6a2bd431.png" alt="Indonesian Temple Scenery" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-amber-100/80 via-amber-100/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 md:p-8">
                    <h1 class="font-dancing-script text-5xl md:text-7xl text-white" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">
                        kamus jawa kuno <br> Indonesia
                    </h1>
                </div>
            </div>

            <!-- Search and Results Section -->
            <div class="p-6 md:p-10 bg-transparent rounded-b-2xl">

                <!-- Search Form -->
                <form action="{{ url('/search') }}" method="POST" class="relative -mt-16 z-10">
                    @csrf
                    <input 
                        type="text" 
                        name="word"
                        value="{{ $word ?? '' }}"
                        placeholder="Ketik kata Indonesia..."
                        class="w-full h-14 pl-6 pr-14 rounded-full border border-gray-300 shadow-inner shadow-gray-100 focus:ring-2 focus:ring-amber-400 focus:outline-none bg-white/80 backdrop-blur-md text-stone-800 placeholder-stone-400"
                    >
                    <button type="submit" class="absolute top-1/2 right-4 transform -translate-y-1/2 text-stone-400 hover:text-amber-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>

                <!-- Results Content -->
                @if(isset($results))
                    <div class="mt-10 space-y-8">

                        <!-- Headword Section -->
                        <div>
                            <h2 class="text-sm font-semibold text-stone-500 tracking-wider uppercase">Headword:</h2>
                            <p class="text-4xl font-bold text-stone-900 mt-2">{{ $word }}</p>
                        </div>

                        <!-- Synonyms -->
                        @if(count($results) > 0)
                            <ul class="text-lg text-stone-700 space-y-1">
                                @foreach($results as $result)
                                    <li>{{ $result['oldJavaneseForm']['value'] }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-lg text-stone-600 italic">Tidak ditemukan padanan Jawa Kuno.</p>
                        @endif
                    </div>
                @endif

            </div>
        </div>
        
        <!-- Footer -->
        <footer class="text-center mt-8">
            <p class="text-stone-500 text-sm">&copy; 2025 Kamus Digital. All Rights Reserved.</p>
        </footer>

    </div>

</body>
</html>
