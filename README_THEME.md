# Theme (Dark / Light) - KM (Laravel + Vue + Tailwind)

This project supports Light/Dark mode using Tailwind’s `darkMode: 'class'` strategy.

## How it works
- Theme preference is stored in **`localStorage`** under the key `theme`.
- On load, the app initializes the theme and toggles the Tailwind `dark` class on the **`<html>`** element.
- Tailwind styles react to the presence/absence of `html.dark`.

## Key files
- **`resources/js/theme.js`**
  - `initTheme()` reads from `localStorage` and applies/removes `dark` class.
  - `toggleTheme()` flips between `light` and `dark` and persists the choice.

- **`resources/js/app.js`**
  - Calls `initTheme()` during app startup.

- **`resources/js/Components/Navigation.vue`**
  - Adds a theme toggle button (“Dark” / “Light”).

- **`resources/views/app.blade.php`**
  - Applies the existing session-based theme class on the `<body>` element (compatible with Tailwind dark mode).

## Usage
- Click the theme toggle button in the navigation bar.
- The selected theme is remembered across page reloads via `localStorage`.

## Notes
- Tailwind config: **`tailwind.config.js`** uses `darkMode: 'class'`.
- Theme toggle is purely client-side; it does not require backend changes.

