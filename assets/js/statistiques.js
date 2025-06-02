function updateChart(period) {
    // Afficher le loading
    document.getElementById('loadingChart').style.display = 'block';
    document.getElementById('salesChart').style.display = 'none';

    // Faire l'appel AJAX
    fetch(`api/chart_data.php?period=${period}`)
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                renderChart(data);
            } else {
                console.error('Erreur:', data.error);
                alert('Erreur lors du chargement des données');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur de connexion');
        })
        .finally(() => {
            // Masquer le loading
            document.getElementById('loadingChart').style.display = 'none';
            document.getElementById('salesChart').style.display = 'block';
        });
}

function renderChart(chartData) {
    const svg = document.getElementById('salesChart');
    const chartLine = document.getElementById('chartLine');
    const chartPoints = document.getElementById('chartPoints');
    const xLabels = document.getElementById('xLabels');
    const yLabels = document.getElementById('yLabels');

    // Paramètres du graphique
    const chartWidth = 700; // 750 - 50 (marge gauche)
    const chartHeight = 150; // 200 - 50 (marge haut)
    const startX = 50;
    const startY = 200;
    const dataLength = chartData.data.length;

    // Calculer les positions X
    const stepX = chartWidth / (dataLength - 1);

    // Calculer l'échelle Y
    const maxValue = chartData.maxValue;
    const scaleY = chartHeight / maxValue;

    // Générer les labels Y
    yLabels.innerHTML = '';
    const ySteps = 4;
    for(let i = 0; i <= ySteps; i++) {
        const value = (maxValue / ySteps) * i; // i=0 -> 0, i=4 -> maxValue
        const y = startY - (chartHeight / ySteps) * i; // Position Y du bas vers le haut
        const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', '30');
        text.setAttribute('y', y + 5);
        text.setAttribute('text-anchor', 'end');
        text.textContent = formatValue(value);
        yLabels.appendChild(text);
    }

    // Générer les labels X
    xLabels.innerHTML = '';
    chartData.labels.forEach((label, index) => {
        const x = startX + (stepX * index);
        const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', x);
        text.setAttribute('y', '220');
        text.setAttribute('text-anchor', 'middle');
        text.setAttribute('font-size', '12');
        text.textContent = label;
        xLabels.appendChild(text);
    });

    // Générer la ligne du graphique
    let pathData = '';
    const points = [];

    chartData.data.forEach((value, index) => {
        const x = startX + (stepX * index);
        const y = startY - (value * scaleY);
        points.push({x, y, value});

        if(index === 0) {
            pathData += `M${x} ${y}`;
        } else {
            pathData += ` L${x} ${y}`;
        }
    });

    chartLine.setAttribute('d', pathData);

    // Générer les points
    chartPoints.innerHTML = '';
    points.forEach(point => {
        const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
        circle.setAttribute('cx', point.x);
        circle.setAttribute('cy', point.y);
        circle.setAttribute('r', '4');
        circle.setAttribute('fill', '#FFD700');

        // Ajouter un titre pour afficher la valeur au survol
        const title = document.createElementNS('http://www.w3.org/2000/svg', 'title');
        title.textContent = formatValue(point.value);
        circle.appendChild(title);

        chartPoints.appendChild(circle);
    });
}

function formatValue(value) {
    // Afficher toujours la valeur complète avec MAD
    if(value >= 1000) {
        return Math.round(value).toLocaleString() + ' MAD';
    } else {
        return Math.round(value) + ' MAD';
    }
}

// Charger les données par défaut au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    updateChart('week');
});