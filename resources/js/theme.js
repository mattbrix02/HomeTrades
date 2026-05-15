const THEME_KEY = 'theme'

export function getStoredTheme() {
  try {
    return localStorage.getItem(THEME_KEY)
  } catch {
    return null
  }

}

export function setStoredTheme(theme) {
  try {
    localStorage.setItem(THEME_KEY, theme)
  } catch {
    // ignore
  }

}

export function applyTheme(theme) {
  const root = document.documentElement
  if (!root) return

  if (theme === 'dark') root.classList.add('dark')
  else root.classList.remove('dark')
}

export function initTheme() {
  const stored = getStoredTheme()

  // Use stored preference if available; otherwise default to light.
  const theme = stored === 'dark' || stored === 'light' ? stored : 'light'
  applyTheme(theme)
  return theme
}

export function toggleTheme(currentTheme) {
  const next = currentTheme === 'dark' ? 'light' : 'dark'
  setStoredTheme(next)
  applyTheme(next)
  return next
}

