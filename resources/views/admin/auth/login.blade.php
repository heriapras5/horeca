<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - {{ $_globalSiteName ?? 'Admin Pusat Furniture' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ $_globalFavicon ?? asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cafe: {
                            50: '#faf6f3', 100: '#f0e6dd', 200: '#e0ccbc', 300: '#d0b29b',
                            400: '#a87d5e', 500: '#8B5A3A', 600: '#6B3A2A', 700: '#5a2e22',
                            800: '#4a251b', 900: '#3a1d14',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center px-4 py-6">

    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">

            @php $_loginLogoSrc = $_globalLogo; @endphp
            @php $_loginSiteName = $_globalSiteName; @endphp
            {{-- Logo --}}
            <div class="text-center mb-6">
                @if ($_loginLogoSrc)
                    <img src="{{ $_loginLogoSrc }}" alt="{{ $_loginSiteName }}" class="h-12 sm:h-14 mx-auto mb-3">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $_loginSiteName }} Admin</h2>
                @else
                    <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-cafe-500 text-white text-2xl sm:text-3xl mb-3">
                        <i class="fas fa-store"></i>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Admin {{ $_loginSiteName }}</h2>
                @endif
                <p class="text-sm text-gray-500 mt-1">Silakan login untuk melanjutkan</p>
            </div>

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="mb-4 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('status'))
                <div class="mb-4 flex items-center gap-3 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-info-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-cafe-500 focus:border-cafe-500 outline-none transition-colors"
                               placeholder="admin@jif.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input id="password" type="password" name="password" required
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-cafe-500 focus:border-cafe-500 outline-none transition-colors"
                               placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-cafe-500 focus:ring-cafe-500">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-cafe-500 hover:bg-cafe-600 text-white font-semibold py-2.5 px-4 rounded-xl transition-colors duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </form>

            {{-- Register Link --}}
            <div class="text-center mt-5">
                <p class="text-sm text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-cafe-500 hover:text-cafe-600 font-semibold">Daftar</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
