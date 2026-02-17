<template>
  <div class="flex flex-col">
    <AppNavigation />
    <main class="flex-grow">
      <NuxtPage />
    </main>
    <AppFooter />
  </div>
</template>

<style>
html, body {
  font-family: 'YourFont', sans-serif;
  @apply antialiased text-gray-800;
}
</style>