const game = new Chess();
const boardEl = document.getElementById('board');
const moveLog = document.getElementById('move-history');

// --- IA OPTIMISÉE POUR ÉVITER LE FREEZE ---
function evaluateBoard(game) {
    const weights = { p: 10, n: 30, b: 30, r: 50, q: 90, k: 900 };
    let score = 0;
    game.board().forEach(row => {
        row.forEach(p => { if (p) score += (p.color === 'w' ? weights[p.type] : -weights[p.type]); });
    });
    return score;
}

function minimax(game, depth, alpha, beta, isMax) {
    if (depth === 0 || game.game_over()) return -evaluateBoard(game);
    const moves = game.moves();
    let best = isMax ? -Infinity : Infinity;

    for (const move of moves) {
        game.move(move);
        const val = minimax(game, depth - 1, alpha, beta, !isMax);
        game.undo();
        if (isMax) { best = Math.max(best, val); alpha = Math.max(alpha, best); }
        else { best = Math.min(best, val); beta = Math.min(beta, best); }
        if (beta <= alpha) break;
    }
    return best;
}

function makeBotMove() {
    if (game.game_over()) return;
    
    boardEl.classList.add('thinking');
    
    // On utilise setTimeout pour libérer le thread principal (évite le freeze)
    setTimeout(() => {
        const diff = parseInt(document.getElementById('difficulty').value);
        // On limite la profondeur à 3 max pour la fluidité sur navigateur
        const depth = Math.min(diff, 3); 
        
        const moves = game.moves();
        let bestMove = moves[Math.floor(Math.random() * moves.length)];
        let bestVal = -Infinity;

        moves.forEach(m => {
            game.move(m);
            const v = minimax(game, depth, -Infinity, Infinity, false);
            game.undo();
            if (v > bestVal) { bestVal = v; bestMove = m; }
        });

        game.move(bestMove);
        boardEl.classList.remove('thinking');
        updateUI();
    }, 100);
}

// --- RENDU SÉCURISÉ ---
function renderBoard() {
    boardEl.innerHTML = '';
    const style = document.getElementById('piece-style').value;
    const position = game.board();

    for (let r = 0; r < 8; r++) {
        for (let c = 0; c < 8; c++) {
            const sqName = `${String.fromCharCode(97 + c)}${8 - r}`;
            const sq = document.createElement('div');
            sq.className = `square ${(r + c) % 2 ? 'black' : 'white'}`;
            sq.dataset.square = sqName;

            const p = position[r][c];
            if (p) {
                const pEl = document.createElement('div');
                const pKey = p.color + p.type.toUpperCase();
                pEl.className = 'piece';
                pEl.style.backgroundImage = `url('https://chessboardjs.com/img/chesspieces/wikipedia/${pKey}.png')`;
                pEl.draggable = true;
                pEl.ondragstart = (e) => e.dataTransfer.setData('text', sqName);
                
                if (p.type === 'k' && p.color === game.turn() && game.in_check()) {
                    sq.classList.add(game.in_checkmate() ? 'checkmate' : 'in-check');
                }
                sq.appendChild(pEl);
            }

            sq.ondragover = (e) => e.preventDefault();
            sq.ondrop = handleDrop;
            boardEl.appendChild(sq);
        }
    }
}

function handleDrop(e) {
    const from = e.dataTransfer.getData('text');
    const to = e.currentTarget.dataset.square;
    if (game.move({ from, to, promotion: 'q' })) {
        updateUI();
        makeBotMove();
    }
}

function updateUI() {
    const history = game.history();
    if (history.length > 0) {
        const last = history[history.length - 1];
        const log = document.createElement('div');
        log.innerHTML = `<span style="opacity:0.4">${history.length}.</span> ${last}`;
        moveLog.prepend(log);
    }
    renderBoard();
}

window.setTheme = (t) => document.body.className = `bg-[#161512] theme-${t}`;
window.resetGame = () => { game.reset(); moveLog.innerHTML = ''; renderBoard(); };

window.onload = renderBoard;