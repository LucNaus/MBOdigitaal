<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                        <th scope="col" class="px-6 py-3">
                            Code
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sbu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Goals Descriptions
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Preconditions
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Teaching Methods
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Certificate
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Link Video
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Link KD
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($keuzedelen as $keuzedeel) {
                        ?>
                        <tr
                            class="odd:bg-white even:bg-gray-50 border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <?php echo $keuzedeel["code"]; ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $keuzedeel["title"]; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $keuzedeel["sbu"]; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $keuzedeel["description"]; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $keuzedeel["goalsDescription"]; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $keuzedeel["preconditions"]; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $keuzedeel["teachingMethods"]; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $keuzedeel["certificate"]; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $keuzedeel["linkVideo"]; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $keuzedeel["linkKD"]; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        