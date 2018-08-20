function drawRating(vote) {
    return vote >= 0 && vote <= 20 ? '*----' :
        vote > 20 && vote <= 40 ? '**---' :
            vote > 40 && vote <= 60 ? '***--' :
                vote > 60 && vote <= 80 ? '****-' :
                    vote > 80 && vote <= 100 ? '*****' : '';
}
