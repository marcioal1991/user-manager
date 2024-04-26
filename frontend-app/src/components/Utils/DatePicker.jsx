import {AdapterDayjs} from '@mui/x-date-pickers/AdapterDayjs';
import {LocalizationProvider} from '@mui/x-date-pickers/LocalizationProvider';
import {DatePicker as MuiDatePicker} from '@mui/x-date-pickers/DatePicker';
import dayjs from "dayjs";

export default function DatePicker({ value, onChange, helperText, ...props })
{
    console.log(value)
    return (
        <LocalizationProvider dateAdapter={AdapterDayjs}>
            <MuiDatePicker {...props}
                           defaultValue={value ? dayjs(value) : null}
                           views={['year', 'month', 'day']}
            />
        </LocalizationProvider>
    )
}
