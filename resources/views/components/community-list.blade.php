<div class="grid grid-cols-4 gap-4">
  @foreach($communities as $community)
    <a href="/search?community={{ $community->id }}" class="border p-4 rounded hover:bg-indigo-50 text-center">
      {{ $community->name }}
    </a>
  @endforeach
</div>
