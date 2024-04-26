import {AdapterDayjs} from '@mui/x-date-pickers/AdapterDayjs';
import {LocalizationProvider} from '@mui/x-date-pickers/LocalizationProvider';
import {DatePicker as MuiDatePicker} from '@mui/x-date-pickers/DatePicker';

export default function DatePicker({ value, onChange, helperText, ...props })
{
    return (
        <LocalizationProvider dateAdapter={AdapterDayjs}>
            <MuiDatePicker {...props} />
        </LocalizationProvider>
    )
}
