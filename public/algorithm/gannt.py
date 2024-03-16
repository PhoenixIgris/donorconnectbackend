import matplotlib.pyplot as plt
import numpy as np

# Define tasks and their start/end dates
tasks = ['Requirement Analysis', 'System Design', 'Implementation', 'Testing', 'Deployment']
start_dates = ['2024-01-01', '2024-01-15', '2024-02-01', '2024-03-01', '2024-03-15']
end_dates = ['2024-01-10', '2024-01-31', '2024-02-28', '2024-03-14', '2024-04-01']

# Convert dates to numerical values
start_dates_num = np.arange(len(tasks))
end_dates_num = np.arange(len(tasks))

for i in range(len(tasks)):
    start_dates_num[i] = np.datetime64(start_dates[i])
    end_dates_num[i] = np.datetime64(end_dates[i])

# Calculate durations
durations = end_dates_num - start_dates_num

# Plot Gantt chart
fig, ax = plt.subplots(figsize=(10, 6))

for i, task in enumerate(tasks):
    ax.barh(task, durations[i], left=start_dates_num[i], height=0.5, align='center', color='skyblue', edgecolor='black')

# Format x-axis
ax.set_xlim(np.datetime64('2024-01-01'), np.datetime64('2024-04-01'))
ax.xaxis_date()

# Set labels and title
ax.set_xlabel('Timeline')
ax.set_ylabel('Tasks')
ax.set_title('DonorConnect Project Gantt Chart')

# Rotate date labels
fig.autofmt_xdate()

# Show grid
ax.grid(True)
plt.savefig('DonorConnect_Gantt_Chart.pdf', bbox_inches='tight')

# Show Gantt chart
plt.show()
