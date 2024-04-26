import ArrowForwardIosIcon from '@mui/icons-material/ArrowForwardIos';
import ArrowBackIosIcon from '@mui/icons-material/ArrowBackIos';
import Box from "@mui/material/Box";
import {FormControl, IconButton, MenuItem, Select} from "@mui/material";
import Typography from "@mui/material/Typography";

export default function UserFooterList ({
                                            nextPage = 2,
                                            previousPage = 1,
                                            currentPage = 1,
                                            totalPages = 1,
                                            setPage,
                                            setRowsPerPage,
                                            rowsPerPage,
}) {
    return (
        <Box sx={{ marginTop: "16px", display: "flex", justifyContent: "flex-end" }}>
            <Box sx={{ display: "flex", alignItems: 'center'}}>
                <Typography sx={{ marginRight: '10px', fontSize: '12px'}}>Rows per page</Typography>
                <FormControl component="span">
                    <Select
                        sx={{ width: "60px", height: "30px", fontSize: "12px"}}
                        value={rowsPerPage}
                        size="small"
                        onChange={(event) => {
                            setRowsPerPage(event.target.value)
                        }}

                    >
                        <MenuItem value={25}>25</MenuItem>
                        <MenuItem value={50}>50</MenuItem>
                        <MenuItem value={75}>75</MenuItem>
                        <MenuItem value={100}>100</MenuItem>
                    </Select>
                </FormControl>

                <Typography sx={{ marginLeft: '10px', marginRight: "10px", fontSize: '12px' }} component="span">{ currentPage } of { totalPages } </Typography>
                <IconButton
                    onClick={() => {
                        setPage(previousPage);
                    }}
                    size="small"
                    disabled={currentPage - 1 < 1}
                    variant="text">
                    <ArrowBackIosIcon />
                </IconButton>
                <IconButton
                    onClick={() => {
                        setPage(nextPage);
                    }}
                    size="small"
                    disabled={currentPage + 1 > totalPages}
                    variant="text">
                    <ArrowForwardIosIcon />
                </IconButton>
            </Box>
        </Box>
    )
}
