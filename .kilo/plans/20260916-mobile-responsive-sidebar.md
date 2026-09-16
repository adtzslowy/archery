# Plan: Add Mobile Responsive Navigation to Laravel Archery App

## Context

The Laravel archery scoring app at `src/` uses a fixed left sidebar (`resources/views/components/navigation/sidebar.blade.php:1`) that is `hidden lg:flex`. On screens below `lg` (1024px), there is **no way to access navigation** — no hamburger button, no mobile drawer, no overlay. All views already use Tailwind responsive prefixes well; the gap is specifically the sidebar/topbar navigation on mobile and tablet.

## Changes

### 1. `resources/views/layouts/app.blade.php` — Add mobile hamburger + mobile sidebar container

- In the topbar (`<header>`), add a hamburger button on the left (visible `sm:hidden`) that toggles Alpine.js state `mobileMenuOpen`
- Add a mobile sidebar `<div>` after the `<x-navigation.sidebar />` that renders the same nav content but as a drawer: `fixed inset-y-0 left-0 z-50 w-64 transform -translate-x-full transition-transform duration-300 lg:hidden` with `:class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"`
- Add a semi-transparent overlay `<div>` behind the mobile drawer that closes the menu when clicked, visible only when `mobileMenuOpen` is true
- Wrap the hamburger + topbar content in `x-data="{ mobileMenuOpen: false }"`

### 2. `resources/views/components/navigation/sidebar.blade.php` — Create mobile drawer variant

- Duplicate the sidebar content into a Blade `@if(\Request::isMobile() ...)` conditional OR (simpler) create the mobile drawer inline in `app.blade.php` using the same nav content via a new partial
- **Approach**: Extract the `<nav>` inner content (logo + nav links + user footer) into a reusable structure, then have both desktop sidebar and mobile drawer reference it
- The mobile drawer needs:
  - Full-height container with `bg-background` and `shadow-xl`
  - A close (X) button at the top-right
  - Same logo/brand header
  - Same navigation links
  - Same user footer at bottom
  - `overflow-y-auto` on the nav section

### 3. Simplified approach (no partial extraction needed)

Since Blade doesn't easily share slots between two different layout placements, the cleanest approach:

- Keep `sidebar.blade.php` as-is (desktop sidebar, hidden below lg)
- Create a new component `components/navigation/mobile-sidebar.blade.php` containing the same nav structure but with mobile-specific classes
- In `app.blade.php`, include both sidebars and control visibility via Tailwind breakpoints + Alpine state

## Files to modify

1. **`src/resources/views/layouts/app.blade.php`** — Add hamburger button, Alpine `x-data`, mobile sidebar include, overlay
2. **`src/resources/views/components/navigation/sidebar.blade.php`** — No structural changes (already correct for desktop)
3. **`src/resources/views/components/navigation/mobile-sidebar.blade.php`** — NEW file: mobile drawer version of nav

## Implementation details

### app.blade.php changes

```
- Wrap entire layout in <div x-data="{ mobileMenuOpen: false }">
- In topbar: add hamburger button before title (visible sm:hidden) with @click="mobileMenuOpen = true"
- After <x-navigation.sidebar />: add mobile drawer div with :class binding and include mobile-sidebar
- Add overlay div with x-show/x-click handlers
```

### mobile-sidebar.blade.php

```
- Clone all content from sidebar.blade.php
- Change outer <aside> classes to mobile drawer: fixed inset-y-0 left-0 z-50 w-64 transform -translate-x-full transition-transform duration-300 ease-in-out bg-background shadow-xl lg:hidden
- Add close button (X icon) in the header section
- Keep all nav links, logo, and footer identical
```

## Verification

1. Run `npm run dev` in `src/` and verify hamburger appears on narrow viewports
2. Click hamburger → drawer slides in from left with full nav
3. Click overlay or close button → drawer slides out
4. On lg+ screens: hamburger hidden, desktop sidebar visible, mobile drawer hidden
5. All nav links functional on mobile drawer
6. Tables already have `overflow-x-auto` — verify horizontal scroll works on mobile
7. All grid layouts already use responsive Tailwind classes — verify stacking on mobile
