// Import Google Material Web Components
import '@material/web/button/filled-button.js';
import '@material/web/button/outlined-button.js';
import '@material/web/button/elevated-button.js';
import '@material/web/button/text-button.js';
import '@material/web/iconbutton/icon-button.js';
import '@material/web/textfield/outlined-text-field.js';
import '@material/web/textfield/filled-text-field.js';
import '@material/web/dialog/dialog.js';
import '@material/web/tabs/tabs.js';
import '@material/web/tabs/primary-tab.js';
import '@material/web/tabs/secondary-tab.js';
import '@material/web/checkbox/checkbox.js';
import '@material/web/switch/switch.js';
import '@material/web/chips/chip-set.js';
import '@material/web/chips/assist-chip.js';
import '@material/web/chips/filter-chip.js';
import '@material/web/divider/divider.js';
import '@material/web/elevation/elevation.js';
import '@material/web/icon/icon.js';

import confetti from 'canvas-confetti';

// Global celebration helper
window.celebrateConfetti = function () {
    const count = 200;
    const defaults = {
        origin: { y: 0.7 }
    };

    function fire(particleRatio, opts) {
        confetti(Object.assign({}, defaults, opts, {
            particleCount: Math.floor(count * particleRatio)
        }));
    }

    fire(0.25, { spread: 26, startVelocity: 55, colors: ['#D4AF37', '#121212', '#FFFFFF', '#E63946'] });
    fire(0.2, { spread: 60, colors: ['#D4AF37', '#8338EC', '#FFB703', '#FB5607'] });
    fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8, colors: ['#E63946', '#F1FAEE', '#A8DADC', '#457B9D', '#1D3557'] });
    fire(0.1, { spread: 120, startVelocity: 25, decay: 0.92, scalar: 1.2, colors: ['#FFD166', '#06D6A0', '#118AB2', '#073B4C'] });
    fire(0.1, { spread: 120, startVelocity: 45, colors: ['#D4AF37', '#000000', '#F7F7F5'] });
};

// Vintage Vinyl Audio Player
window.initAudioPlayer = function () {
    const audio = document.getElementById('vintage-audio-el');
    const playBtn = document.getElementById('audio-play-btn');
    const playIcon = document.getElementById('audio-play-icon');
    const statusText = document.getElementById('audio-status-text');
    const vinylDisc = document.getElementById('vinyl-disc');
    const statusDot = document.getElementById('vinyl-status-dot');

    if (!audio || !playBtn) return;

    playBtn.addEventListener('click', () => {
        if (audio.paused) {
            audio.play().then(() => {
                if (playIcon) playIcon.innerText = 'pause';
                if (statusText) statusText.innerText = 'Memutar: Isimo - Bleachers';
                if (vinylDisc) vinylDisc.classList.add('is-playing');
                if (statusDot) statusDot.classList.remove('hidden');
            }).catch(e => {
                console.log('Audio playback error', e);
            });
        } else {
            audio.pause();
            if (playIcon) playIcon.innerText = 'play_arrow';
            if (statusText) statusText.innerText = 'Musik Dijeda';
            if (vinylDisc) vinylDisc.classList.remove('is-playing');
            if (statusDot) statusDot.classList.add('hidden');
        }
    });

    audio.addEventListener('ended', () => {
        if (playIcon) playIcon.innerText = 'play_arrow';
        if (statusText) statusText.innerText = 'Klik untuk Putar';
        if (vinylDisc) vinylDisc.classList.remove('is-playing');
        if (statusDot) statusDot.classList.add('hidden');
    });
};

// Interactive Crossword Engine
window.initCrossword = function (gridMatrix, cluesAcross, cluesDown) {
    const container = document.getElementById('nyt-crossword-board');
    if (!container || !gridMatrix) return;

    let selectedRow = 0;
    let selectedCol = 0;
    let direction = 'across'; // 'across' or 'down'
    const inputs = {};

    function renderBoard() {
        container.innerHTML = '';
        container.style.gridTemplateColumns = `repeat(${gridMatrix[0].length}, 1fr)`;

        gridMatrix.forEach((row, rIdx) => {
            row.forEach((cell, cIdx) => {
                const cellDiv = document.createElement('div');
                cellDiv.className = 'crossword-cell' + (cell.isBlack ? ' is-black' : '');
                cellDiv.dataset.row = rIdx;
                cellDiv.dataset.col = cIdx;

                if (!cell.isBlack) {
                    if (cell.number > 0) {
                        const numSpan = document.createElement('span');
                        numSpan.className = 'cell-number';
                        numSpan.innerText = cell.number;
                        cellDiv.appendChild(numSpan);
                    }

                    const input = document.createElement('input');
                    input.type = 'text';
                    input.maxLength = 1;
                    input.autocomplete = 'off';
                    input.spellcheck = false;
                    input.dataset.expected = cell.char.toUpperCase();
                    input.dataset.row = rIdx;
                    input.dataset.col = cIdx;

                    inputs[`${rIdx}-${cIdx}`] = input;

                    input.addEventListener('focus', () => {
                        selectedRow = rIdx;
                        selectedCol = cIdx;
                        highlightClue();
                        updateHighlight();
                    });

                    input.addEventListener('click', () => {
                        if (selectedRow === rIdx && selectedCol === cIdx) {
                            direction = direction === 'across' ? 'down' : 'across';
                            highlightClue();
                            updateHighlight();
                        }
                    });

                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace') {
                            if (!input.value) {
                                moveToPrevCell(rIdx, cIdx);
                            }
                        } else if (e.key === 'ArrowRight') {
                            moveToCell(rIdx, cIdx + 1);
                        } else if (e.key === 'ArrowLeft') {
                            moveToCell(rIdx, cIdx - 1);
                        } else if (e.key === 'ArrowDown') {
                            moveToCell(rIdx + 1, cIdx);
                        } else if (e.key === 'ArrowUp') {
                            moveToCell(rIdx - 1, cIdx);
                        }
                    });

                    input.addEventListener('input', (e) => {
                        input.value = input.value.toUpperCase();
                        if (input.value.length === 1) {
                            moveToNextCell(rIdx, cIdx);
                        }
                        checkVictory();
                    });

                    cellDiv.appendChild(input);
                }

                container.appendChild(cellDiv);
            });
        });
    }

    function moveToNextCell(r, c) {
        if (direction === 'across') {
            for (let nextC = c + 1; nextC < gridMatrix[0].length; nextC++) {
                if (inputs[`${r}-${nextC}`]) {
                    inputs[`${r}-${nextC}`].focus();
                    return;
                }
            }
        } else {
            for (let nextR = r + 1; nextR < gridMatrix.length; nextR++) {
                if (inputs[`${nextR}-${c}`]) {
                    inputs[`${nextR}-${c}`].focus();
                    return;
                }
            }
        }
    }

    function moveToPrevCell(r, c) {
        if (direction === 'across') {
            for (let prevC = c - 1; prevC >= 0; prevC--) {
                if (inputs[`${r}-${prevC}`]) {
                    inputs[`${r}-${prevC}`].focus();
                    return;
                }
            }
        } else {
            for (let prevR = r - 1; prevR >= 0; prevR--) {
                if (inputs[`${prevR}-${c}`]) {
                    inputs[`${prevR}-${c}`].focus();
                    return;
                }
            }
        }
    }

    function moveToCell(r, c) {
        if (inputs[`${r}-${c}`]) {
            inputs[`${r}-${c}`].focus();
        }
    }

    function updateHighlight() {
        document.querySelectorAll('.crossword-cell').forEach(el => el.classList.remove('is-active', 'is-highlighted'));

        const currentCell = container.querySelector(`[data-row="${selectedRow}"][data-col="${selectedCol}"]`);
        if (currentCell) currentCell.classList.add('is-active');

        // Highlight word in current direction
        if (direction === 'across') {
            for (let c = 0; c < gridMatrix[0].length; c++) {
                const cell = container.querySelector(`[data-row="${selectedRow}"][data-col="${c}"]`);
                if (cell && !gridMatrix[selectedRow][c].isBlack) {
                    cell.classList.add('is-highlighted');
                }
            }
        } else {
            for (let r = 0; r < gridMatrix.length; r++) {
                const cell = container.querySelector(`[data-row="${r}"][data-col="${selectedCol}"]`);
                if (cell && !gridMatrix[r][selectedCol].isBlack) {
                    cell.classList.add('is-highlighted');
                }
            }
        }
    }

    function highlightClue() {
        document.querySelectorAll('.clue-item').forEach(el => el.classList.remove('is-active-clue'));
        // Find clue for current cell and direction
        // (Simple matching by coordinate / direction)
    }

    function checkVictory() {
        let allFilled = true;
        let allCorrect = true;

        Object.keys(inputs).forEach(key => {
            const input = inputs[key];
            if (!input.value) {
                allFilled = false;
            } else if (input.value !== input.dataset.expected) {
                allCorrect = false;
            }
        });

        if (allFilled && allCorrect) {
            const victoryModal = document.getElementById('crossword-victory-dialog');
            if (victoryModal) {
                victoryModal.show();
            }
            window.celebrateConfetti();
        }
    }

    renderBoard();

    // Reveal Solution Helper
    window.revealCrossword = function () {
        Object.keys(inputs).forEach(key => {
            const input = inputs[key];
            input.value = input.dataset.expected;
        });
        checkVictory();
    };

    window.clearCrossword = function () {
        Object.keys(inputs).forEach(key => {
            const input = inputs[key];
            input.value = '';
        });
    };
};

// Theme Toggles: Newspaper Classic / Sepia Archival / Night Ink
window.initThemeSwitch = function () {
    const themeButtons = document.querySelectorAll('[data-newspaper-theme]');

    function applyTheme(theme) {
        document.body.className = '';
        if (theme && theme !== 'classic') {
            document.body.classList.add('theme-' + theme);
        }

        themeButtons.forEach(btn => {
            if (btn.dataset.newspaperTheme === (theme || 'classic')) {
                btn.style.backgroundColor = 'var(--nyt-black)';
                btn.style.color = 'var(--nyt-paper)';
                btn.style.fontWeight = 'bold';
            } else {
                btn.style.backgroundColor = 'transparent';
                btn.style.color = 'var(--nyt-black)';
                btn.style.fontWeight = 'normal';
            }
        });
    }

    themeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const theme = btn.dataset.newspaperTheme;
            applyTheme(theme);
            localStorage.setItem('nyt_newspaper_theme', theme);
        });
    });

    const savedTheme = localStorage.getItem('nyt_newspaper_theme') || 'classic';
    applyTheme(savedTheme);
};

document.addEventListener('DOMContentLoaded', () => {
    window.initAudioPlayer();
    window.initThemeSwitch();
});
