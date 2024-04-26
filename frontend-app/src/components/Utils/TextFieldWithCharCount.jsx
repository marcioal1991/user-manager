import TextField from "@mui/material/TextField";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";

export default function TextFieldWithCharCount({ maxLength, helperText, ...props }) {
    return (
        <TextField
            {...props}
            helperText={
            <Box
                component="span"
                sx={{ display: "flex", justifyContent: "space-between" }}
            >
                <Typography sx={{ fontSize: '12px' }} component="span">
                    { helperText }
                </Typography>
                <Typography component="span" sx={{ fontSize: '12px' }}>
                    { props.value?.length || 0 } / { maxLength }
                </Typography>
            </Box>
        } />
    )
}
