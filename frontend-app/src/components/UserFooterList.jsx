import ArrowForwardIosIcon from '@mui/icons-material/ArrowForwardIos';
import ArrowBackIosIcon from '@mui/icons-material/ArrowBackIos';
import Box from "@mui/material/Box";
import {FormControl, IconButton, MenuItem, Select} from "@mui/material";
import Typography from "@mui/material/Typography";

export default function UserFooterList ({ currentPage = 1, totalPages = 1 }) {
    return (
        <Box sx={{ marginTop: "16px", display: "flex", justifyContent: "flex-end" }}>
            <Box sx={{ display: "flex", alignItems: 'center'}}>
                <Typography sx={{ marginRight: '10px', fontSize: '12px'}}>Rows per page</Typography>
                <FormControl component="span">
                    <Select
                        sx={{ width: "60px", height: "30px", fontSize: "12px"}}
                        value="10"
                        size="small"
                    >
                        <MenuItem value={10}>10</MenuItem>
                        <MenuItem value={20}>20</MenuItem>
                        <MenuItem value={30}>30</MenuItem>
                    </Select>
                </FormControl>

                <Typography sx={{ marginLeft: '10px', marginRight: "10px", fontSize: '12px' }} component="span">{ currentPage } of { totalPages } </Typography>
                <IconButton size="small" variant="text">
                    <ArrowBackIosIcon />
                </IconButton>
                <IconButton size="small" variant="text">
                    <ArrowForwardIosIcon />
                </IconButton>
            </Box>
        </Box>
    )
}
