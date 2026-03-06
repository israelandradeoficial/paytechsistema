import './bootstrap';

import Alpine from 'alpinejs';

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import 'admin-lte/dist/js/adminlte.min.js';

window.Alpine = Alpine;

Alpine.start();

// Theme Switcher Logic
(() => {
    'use strict'

    const getStoredTheme = () => localStorage.getItem('theme')
    const setStoredTheme = theme => localStorage.setItem('theme', theme)

    const getPreferredTheme = () => {
        const storedTheme = getStoredTheme()
        if (storedTheme) {
            return storedTheme
        }

        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
    }

    const setTheme = theme => {
        if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-bs-theme', 'dark')
        } else {
            document.documentElement.setAttribute('data-bs-theme', theme)
        }
    }

    setTheme(getPreferredTheme())

    const showActiveTheme = (theme, focus = false) => {
        const themeSwitcher = document.querySelector('#bd-theme')

        if (!themeSwitcher) {
            return
        }

        const themeSwitcherText = document.querySelector('#bd-theme-text')
        const activeThemeIcon = document.querySelector('.theme-icon-active')
        const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)

        if (!btnToActive) {
            return
        }

        const iconElement = btnToActive.querySelector('i')

        document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
            element.classList.remove('active')
            element.setAttribute('aria-pressed', 'false')
        })

        btnToActive.classList.add('active')
        btnToActive.setAttribute('aria-pressed', 'true')

        // Update switcher icon
        if (activeThemeIcon && iconElement) {
            const iconClass = iconElement.className.replace('me-2 opacity-50 theme-icon', '').trim()
            activeThemeIcon.className = iconClass + ' my-1 theme-icon-active'
        }

        if (themeSwitcherText) {
            const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.textContent.trim()})`
            themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)
        }

        if (focus) {
            themeSwitcher.focus()
        }
    }

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        const storedTheme = getStoredTheme()
        if (storedTheme !== 'light' && storedTheme !== 'dark') {
            setTheme(getPreferredTheme())
        }
    })

    window.addEventListener('DOMContentLoaded', () => {
        showActiveTheme(getPreferredTheme())

        document.querySelectorAll('[data-bs-theme-value]')
            .forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const theme = toggle.getAttribute('data-bs-theme-value')
                    setStoredTheme(theme)
                    setTheme(theme)
                    showActiveTheme(theme, true)
                })
            })
    })
})()
