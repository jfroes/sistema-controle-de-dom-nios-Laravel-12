
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$title ?? 'Page'}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="{{ $ui['pageBg'] }} min-h-screen">


@guest
    <main class="min-h-screen flex items-center justify-center px-4 py-10">
        {{$slot}}
    </main>
@endguest

@auth
    @if(Auth::user()->must_change_password)
        <header class="bg-white border-b border-slate-200">
            <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
                <h1 class="text-lg font-semibold text-slate-900">Sistema de Domínios</h1>
                <a href="{{route('logout')}}" class="{{ $ui['btnSecondary'] }}">Sair</a>
            </div>
        </header>
        <main class="max-w-6xl mx-auto px-4 py-8">
            {{$slot}}
        </main>
    @else
        <div class="flex min-h-screen">
            <x-admin.sidebar />
            <main class="flex-1 p-6 md:p-8">
                {{$slot}}
            </main>
        </div>
    @endif

@endauth

<x-layouts.partials.flash-messages/>
</body>
</html>
