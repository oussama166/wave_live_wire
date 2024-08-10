import {
    Chart,
    BarController,
    BarElement,
    BubbleController,
    DoughnutController,
    LineController,
    PieController,
    PolarAreaController,
    RadarController,
    ScatterController,
    ArcElement,
    LineElement,
    PointElement,
    CategoryScale,
    LinearScale,
    LogarithmicScale,
    RadialLinearScale,
    TimeScale,
    TimeSeriesScale,
    Decimation,
    Filler,
    Legend,
    Title,
    Tooltip,
    SubTitle
} from 'chart.js';

// Register all necessary components
Chart.register(
    BarController,
    BarElement,
    BubbleController,
    DoughnutController,
    LineController,
    PieController,
    PolarAreaController,
    RadarController,
    ScatterController,
    ArcElement,
    LineElement,
    PointElement,
    CategoryScale,
    LinearScale,
    LogarithmicScale,
    RadialLinearScale,
    TimeScale,
    TimeSeriesScale,
    Decimation,
    Filler,
    Legend,
    Title,
    Tooltip,
    SubTitle
);

export function initializeChart(ctx, data, type, customOptions = {}) {
    // Default configuration options
    const defaultOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            title: {
                display: true,
                text: 'Chart Title'  // Default title, can be overridden by customOptions
            },
            tooltip: {}
        }
    };

    // Merge the default options with any custom options provided
    const options = { ...defaultOptions, ...customOptions };

    // Initialize the chart
    return new Chart(ctx, {
        type: type,
        data: data,
        options: options
    });
}
