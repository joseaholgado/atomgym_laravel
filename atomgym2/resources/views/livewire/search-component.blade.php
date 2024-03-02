<style>
    
.lupa{
    margin-top:15px;
    transform: translateY(5px);
}
</style>

<form method="GET" action="{{ route('dashboard') }}">
    <input class="" type="text" name="busqueda" placeholder="Buscar..." value="{{ $busqueda }}" style="border-radius:20px">
    <button type="submit" >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" stroke-width="1.5" stroke="#99793D" class="w-7 h-7 lupa">
            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>

    </button>
</form>

